<?php

namespace App\Http\Controllers;

use App\Enum\Code;
use App\Enum\LogChannel;
use App\Enum\OrderBy;
use App\Enum\PermissionType;
use App\Enum\UserAction;
use App\Exceptions\CustomizeException;
use App\Logging\Logger;
use App\Models\Permissions;
use App\Services\AuthorizeService;
use App\Services\ResponseService as Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class PermissionController extends Controller
{
    /**
     * 权限管理(页面列表/搜索)
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // 验证参数
            $validator = Validator::make($request->all()
                , [
                    'uuid' => 'string|max:100', // 唯一标识
                    'title' => 'string|max:100', // 权限名称
                    'module' => 'string|max:250', // 权限匹配模型(路由名称 | 控制器/方法)
                    'type' => [ // 类型
                        'array',
                        Rule::in(PermissionType::values()),
                    ],
                    'pid' => 'integer|min:0', // 上级id
                    'is_genealogy' => 'integer|min:0', // 0 直属, 1 族谱
                    'field' => 'string', // 排序字段
                    'order' => [ // 排序方式
                        new Enum(OrderBy::class),
                    ],
                    'cache' => 'boolean' // true 查缓存, 1 查表
                ]);
            if ($validator->fails()) {
                throw new CustomizeException(Code::FAIL, $validator->errors()->first());
            }

            // 查询数据
            $result = AuthorizeService::permissionIndex($request, $validator->validated());
            return Response::success($result);
        } catch (CustomizeException $e) {
            return Response::fail($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error(LogChannel::DEFAULT, __METHOD__, [], $e);
            $this->systemException(__METHOD__, $e);
            return Response::fail(Code::SYSTEM_ERR);
        }
    }

    /**
     * 新增权限
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        try {
            // 验证参数
            $validator = Validator::make($request->all()
                , [
                    'uuid' => 'required|string|max:100', // 唯一标识(前端权限标识)
                    'title' => 'required|string|max:100', // 权限名称
                    'module' => 'nullable|string|max:250', // 后端权限匹配模型(路由名称 | 控制器/方法)
                    'type' => [ // 类型
                        'required',
                        new Enum(PermissionType::class),
                    ],
                    'pid' => 'required|integer|min:0', // 上级id
                    'describe' => 'required|string|max:255',
                ]);
            if ($validator->fails()) {
                throw new CustomizeException(Code::FAIL, $validator->errors()->first());
            }

            $input = $validator->validated();

            // 新增权限
            $result = AuthorizeService::permissionAdd($request, $input);
            if (!$result) {
                throw new CustomizeException(Code::F2000);
            }

            // 记录操作日志
            $this->addUserLog(__FUNCTION__, UserAction::ADD_PERMISSION, 'title=' . $input['title'], $input);
            return Response::success([], Code::S1000);
        } catch (CustomizeException $e) {
            return Response::fail($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error(LogChannel::DEFAULT, __METHOD__, [], $e);
            $this->systemException(__METHOD__, $e);
            return Response::fail(Code::SYSTEM_ERR);
        }
    }

    /**
     * 编辑
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function edit(Request $request, int $id): JsonResponse
    {
        try {
            // 验证参数
            $validator = Validator::make($request->all()
                , [
                    'title' => 'required|string|max:100', // 权限名称
                    'module' => 'nullable|string|max:250', // 后端权限匹配模型(路由名称 | 控制器/方法)
                    'type' => [ // 类型
                        'required',
                        new Enum(PermissionType::class),
                    ],
                    'describe' => 'required|string|max:255',
                ]);
            if ($validator->fails()) {
                throw new CustomizeException(Code::FAIL, $validator->errors()->first());
            }

            $input = $validator->validated();

            // 编辑权限
            $result = AuthorizeService::permissionEdit($request, $id, $input);
            if (!$result) {
                throw new CustomizeException(Code::F2001);
            }

            // 记录操作日志
            $this->addUserLog(__FUNCTION__, UserAction::EDIT_PERMISSION, 'title=' . $input['title'], $input);
            return Response::success([], Code::S1001);
        } catch (CustomizeException $e) {
            return Response::fail($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error(LogChannel::DEFAULT, __METHOD__, [], $e);
            $this->systemException(__METHOD__, $e);
            return Response::fail(Code::SYSTEM_ERR);
        }
    }

    /**
     * 删除
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function del(Request $request, int $id): JsonResponse
    {
        try {
            // 删除权限信息
            $result = AuthorizeService::permissionDel($request, $id);
            if (!$result) {
                throw new CustomizeException(Code::F2002);
            }
            // 记录操作日志
            $this->addUserLog(__FUNCTION__, UserAction::DEL_PERMISSION, 'permissions.id=' . $id);
            return Response::success([], Code::S1002);
        } catch (CustomizeException $e) {
            return Response::fail($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error(LogChannel::DEFAULT, __METHOD__, [], $e);
            $this->systemException(__METHOD__, $e);
            return Response::fail(Code::SYSTEM_ERR);
        }
    }

    /**
     * 上级权限
     * @param Request $request
     * @return JsonResponse
     */
    public function treeList(Request $request): JsonResponse
    {
        try {
            // 查询数据
            $result = AuthorizeService::permissionTreeList($request);
            return Response::success($result);
        } catch (CustomizeException $e) {
            return Response::fail($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error(LogChannel::DEFAULT, __METHOD__, [], $e);
            $this->systemException(__METHOD__, $e);
            return Response::fail(Code::SYSTEM_ERR);
        }
    }

    /**
     * 获取最大的uuid
     * @param Request $request
     * @return JsonResponse
     */
    public function maxUuid(Request $request): JsonResponse
    {
        try {
            // 查询数据
            $uuid = Permissions::max('id');
            return Response::success(['uuid' => $uuid + 100001]);
        } catch (CustomizeException $e) {
            return Response::fail($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            Logger::error(LogChannel::DEFAULT, __METHOD__, [], $e);
            $this->systemException(__METHOD__, $e);
            return Response::fail(Code::SYSTEM_ERR);
        }
    }
}