<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => env('ALI_APP_ID', '2016091900544672'),

        // 支付宝异步通知地址
        'notify_url' => 'http://s.qingwuit.com/api/Shop/pay/index',

        // 支付成功后同步通知地址
        'return_url' => 'http://localhost:3000/order/success/**',

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => env('ALI_PUBLIC_KEY', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAst5MRkwRs3nHQ8prdrgbyMlv2tleqlztqMWliGmIzJ2g3lDbcDcS4YDHXKWCx6wheDuWPuaEOc735Jzxb8LKM1dWt+VF15vdcY270vKwV8PV04HEjUyjaAj9Z0PynHwnsr/DCy3hszOXagIbLSSdI8oGEDaNd2LhWiyBCbJRATFDNeTcOqkNyKXyAPRkA4dYvtxD/I37w5h0PjVSEBERWQMWHKqKczQ6BICX93F5DdmB7p2eOG5/0pFpBqDh3XWfxlcl6QoBEMQSLNEi+MBPvkEEFtAhYB0chPjCZf4LHk+eJrv1tcQBo5kgirZNRnRhuWVaMS/c9/+k3Zwo3kykLQIDAQAB'),

        // 自己的私钥，签名时使用
        'private_key' => env('ALI_PRIVATE_KEY', 'MIIEowIBAAKCAQEAst5MRkwRs3nHQ8prdrgbyMlv2tleqlztqMWliGmIzJ2g3lDbcDcS4YDHXKWCx6wheDuWPuaEOc735Jzxb8LKM1dWt+VF15vdcY270vKwV8PV04HEjUyjaAj9Z0PynHwnsr/DCy3hszOXagIbLSSdI8oGEDaNd2LhWiyBCbJRATFDNeTcOqkNyKXyAPRkA4dYvtxD/I37w5h0PjVSEBERWQMWHKqKczQ6BICX93F5DdmB7p2eOG5/0pFpBqDh3XWfxlcl6QoBEMQSLNEi+MBPvkEEFtAhYB0chPjCZf4LHk+eJrv1tcQBo5kgirZNRnRhuWVaMS/c9/+k3Zwo3kykLQIDAQABAoIBAD7SiOOf0A/DU9NhgwD9hPSum1S4R+F6JhbC5HLW7i8/pcKvj4MINN9zBZJqp1ZOBKtf8lNBT2umX7ax0LK6LZ5+rHyGUFN78PjzGObsSjdpFu7kgw5FvpbJoYblfI6tpJvJck243a69Dg8zkiv20iJB0INdRa6K0i+Dtgab1IugFUXQh9lmAlBHZtIWYXU/sC/AQdo+RAZcb8Qo1fXNnSNwzlyY3lQVKg6FVKF0LMK54C0sqs9of3mkCgkO0l2jEt0zBWxXgJuxxceYX/BgLs8ffcaCaf7X74yIP5wj8Z+o7m3QNqubfyWg7Z/aD31tQxkg/dM232hxofDlSLfK99kCgYEA4MMoSNZPdPGA+vu5qEt1yU4uZXZOQMBkKY0TQccErJydU9clUgKTFA6XGjKeOTqhHbGI02HMZVqYdQQ6YuxNDPHm8/sOfoqjaUu7yuNh8IbSI9bbe3BHJjIzXlj91+F6EhIJNtPCTsVZ2TZbOVcoZZPKd8wBfXAmzx1lmn8rS5sCgYEAy7pGFqx3AY82UyiVSp15k7eWHhznEKpFD9nxcCXGZ7RvWRbAPovccqMmpeMoBEqjasQ5Hbd6Un+Vy6ATIj+YXRYrQXC90XPiOmcqTXcJz7Wd7uLR9wt2gtoxBn2OwtiIQAte/l4fkDNIeTaCMG8wOCIW7O+0pmfqg6TzhMXPP9cCgYBoKKirkH2EAUM3jJ5OKqIsJwoDRR8gjMgeJV2ONw+oem/CYcrOxZipS9Wkc161wMDXhOWWqBTTx3cti0cPfth6LkRMPsVJyS/PZSRi8pr5n1EVAMX332FphwwdJfqFJ92tMCSK/vlmDbkEm1cNLKHw6NuERstN+UJS6xmhzlsfDwKBgFus5+s+EpNWEZkcMwoPkO0C+P91/BiItmkqprXTmdOC43RQg5PhtgK0HikZ7iD4QU9DG3ye2uGS3iJyVwnbWkHRPwfEpvZA0nV7hRK01WptjLM5yEgGFX9Oli8Ygwx1CeLf+xA15LgsC5nYCH+pGSa5WF2ohD85ldNFf/uoU9mjAoGBAK0y8pD3lEUVqwK35yMWOma/zW9FonfFlHh6LXInk8Kf+x35dLXprzUkfhFXfbHXIt1rCTSITJEyUu/PfCLta6aMASUai5Xbkwlszd/p5XiRbBZNj6Uj5GLAlAokQG0janNF+yRsY4MdUA++xskCgqMvz9qYHinvVimkA98BmjCF'),

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        //  'level' => 'debug'
        //  'type' => 'single', // optional, 可选 daily.
        //  'max_file' => 30,
        ],

        // optional，设置此参数，将进入沙箱模式
        // 'mode' => 'dev',
    ],

    'wechat' => [
        // 公众号 APPID
        'app_id' => env('WECHAT_APP_ID', 'wx5b0a018866eb22bf'),

        // 小程序 APPID
        'miniapp_id' => env('WECHAT_MINIAPP_ID', ''),

        // APP 引用的 appid
        'appid' => env('WECHAT_APPID', ''),

        // 微信支付分配的微信商户号
        'mch_id' => env('WECHAT_MCH_ID', '1538497901'),

        // 微信支付异步通知地址
        'notify_url' => 'http://s.qingwuit.com/api/Shop/pay/wechat_index',

        // 微信支付签名秘钥
        'key' => env('WECHAT_KEY', 'l73fAeSw6Vy76inufzlSQsudMX6Muejh'),

        // 客户端证书路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => '',

        // 客户端秘钥路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => '',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
        //  'level' => 'debug'
        //  'type' => 'single', // optional, 可选 daily.
        //  'max_file' => 30,
        ],

        // optional
        // 'dev' 时为沙箱模式
        // 'hk' 时为东南亚节点
        // 'mode' => 'dev',
    ],
];
