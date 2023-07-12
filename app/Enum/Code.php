<?php

namespace App\Enum;

/**
 *  消息状态码
 */
enum Code: int
{
    // 系统信息
    const SUCCESS = 0; // 成功
    const FAIL = 1; // 失败
    const SYSTEM_ERR = 2; // 系统异常
    const DB_ERR = 3; // 系统异常
    const UNAUTHORIZED = 4; // 未经授权
    const INVALID_AUTHORIZATION = 5; // 授权无效

    // 常用成功信息
    const S1000 = 1000; // 添加成功
    const S1001 = 1001; // 更新成功
    const S1002 = 1002; // 删除成功
    const S1003 = 1003; // 保存成功
    const S1004 = 1004; // 启用成功
    const S1005 = 1005; // 禁用成功
    const S1006 = 1006; // 显示成功
    const S1007 = 1007; // 隐藏成功

    // 常用失败信息
    const F2000 = 2000; // 添加失败
    const F2001 = 2001; // 更新失败
    const F2002 = 2002; // 删除失败
    const F2003 = 2003; // 保存失败
    const F2004 = 2004; // 启用失败
    const F2005 = 2005; // 禁用失败
    const F2006 = 2006; // 显示失败
    const F2007 = 2007; // 隐藏失败

    // 错误信息
    // 100000-101000 已被占用, 他人勿用
    const E100000 = 100000; // 密码不能为空
    const E100001 = 100001; // 密码必须大于8个字符
    const E100002 = 100002; // 密码不能全是数字，请包含数字，大小写字母或特殊字符
    const E100003 = 100003; // 密码不能全是字母，请包含数字，大小写字母或特殊字符
    const E100004 = 100004; // 请包含数字，字母大小写或者特殊字符
    const E100005 = 100005; // 旧密码错误，请检查
    const E100006 = 100006; // 密码更新成功,即将刷新页面...;
    const E100007 = 100007; // 用户名必须
    const E100008 = 100008; // 用户名由字母和数组组成
    const E100009 = 100009; // 用户名长度为:6-20位
    const E100010 = 100010; // 信息错误(ATE100010), 请刷新页面
    const E100011 = 100011; // 密码必须
    const E100012 = 100012; // 密码长度为:8-20位
    const E100013 = 100013; // 验证码必须
    const E100014 = 100014; // 验证码错误
    const E100015 = 100015; // 账号或密码错误,请重试
    const E100016 = 100016; // 认证信息已过期,请重新登录
    const E100017 = 100017; // 认证信息无法解析
    const E100018 = 100018; // 认证信息错误
    const E100019 = 100019; // 密码错误
    const E100020 = 100020; // 账号未启用, 请联系管理员
    const E100021 = 100021; // 无法获取账号信息
    const E100022 = 100022; // 上级角色不存在
    const E100023 = 100023; // 同级别存在相同角色
    const E100024 = 100024; // 角色不存在
    const E100025 = 100025; // 超级管理员角色不能编辑
    const E100026 = 100026; // 该角色存在下级角色不能删除
    const E100027 = 100027; // 该角色与用户关系解除失败
    const E100028 = 100028; // 上级角色未启用,该角色状态和权限不能编辑
    const E100029 = 100029; // 该角色没有权限拥有此[{permission}]权限
    const E100030 = 100030; // 只能添加您所拥有角色的下级角色
    const E100031 = 100031; // 您没有权限编辑该角色
    const E100032 = 100032; // 该角色下级角色状态禁用失败
    const E100033 = 100033; // 管理者角色不能删除及修改状态
    const E100034 = 100034; // uuid[{uuid}]已经存在
    const E100035 = 100035; // module[{module}]已经存在
    const E100036 = 100036; // 父级权限不存在
    const E100037 = 100037; // 权限不存在
    const E100038 = 100038; // 此权限已经分配给角色[{title}],请先取消该权限再做删除
    const E100039 = 100039; // 此权限已经分配给菜单[{title}],不能删除
    const E100040 = 100040; // 此权限已经分配给菜单[{title}],无法重复分配
    const E100041 = 100041; // 父级菜单不存在
    const E100042 = 100042; // 菜单不存在
    const E100043 = 100043; // 尚未绑定Google验证码秘钥，请先绑定
    const E100044 = 100044; // 角色不存在或已禁用
    const E100045 = 100045; // 您没有权限分配角色[{title}]给该用户
    const E100046 = 100046; // 您没有权限解除此角色与该用户于的关系
    const E100047 = 100047; // 账号[{name}]已存在
    const E100048 = 100048; // Google验证码验证失败
    const E100049 = 100049; // 角色id不是有效的参数
    const E100050 = 100050; // 您没有权限解除此角色[{title}]与该用户于的关系
    const E100051 = 100051; // 角色与账号关系解除失败
    const E100052 = 100052; // 角色与账号关系绑定失败
    const E100053 = 100053; // 账号不存在
    const E100054 = 100054; // uuid[{uuid}]已存在
    const E100055 = 100055; // 配置不存在
    const E100056 = 100056; // 登录失败（更新登录信息失败）
    const E100057 = 100057; // 您的IP地址已变更，请重新登录！
    const E100058 = 100058; // IP未经授权！
    const E100059 = 100059; // 不能修改自己的数据！
    const E100060 = 100060; // 无权限修改数据！
    const E100061 = 100061; // 您的账号状态当前已被禁用，请联系管理员！

    // 100000-101000 已被占用, 他人勿用

}