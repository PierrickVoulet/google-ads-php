<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v6/common/frequency_cap.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V6\Common;

class FrequencyCap
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Http::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0ac5030a3b676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6672657175656e63795f6361705f74696d655f756e69742e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d73226e0a184672657175656e637943617054696d65556e6974456e756d22520a144672657175656e637943617054696d65556e6974120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e100112070a03444159100212080a045745454b100312090a054d4f4e5448100442ee010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7342194672657175656e637943617054696d65556e697450726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330acb030a3c676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6672657175656e63795f6361705f6576656e745f747970652e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7322720a194672657175656e63794361704576656e7454797065456e756d22550a154672657175656e63794361704576656e7454797065120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e1001120e0a0a494d5052455353494f4e1002120e0a0a564944454f5f56494557100342ef010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d73421a4672657175656e63794361704576656e745479706550726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330ac7030a37676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6672657175656e63795f6361705f6c6576656c2e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7322770a154672657175656e63794361704c6576656c456e756d225e0a114672657175656e63794361704c6576656c120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e1001120f0a0b41445f47524f55505f41441002120c0a0841445f47524f55501003120c0a0843414d504149474e100442eb010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7342164672657175656e63794361704c6576656c50726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330aa6070a32676f6f676c652f6164732f676f6f676c656164732f76362f636f6d6d6f6e2f6672657175656e63795f6361702e70726f746f121e676f6f676c652e6164732e676f6f676c656164732e76362e636f6d6d6f6e1a37676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6672657175656e63795f6361705f6c6576656c2e70726f746f1a3b676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6672657175656e63795f6361705f74696d655f756e69742e70726f746f1a1c676f6f676c652f6170692f616e6e6f746174696f6e732e70726f746f226b0a114672657175656e6379436170456e747279123c0a036b657918012001280b322f2e676f6f676c652e6164732e676f6f676c656164732e76362e636f6d6d6f6e2e4672657175656e63794361704b657912100a03636170180320012805480088010142060a045f63617022d7020a0f4672657175656e63794361704b657912550a056c6576656c18012001280e32462e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e4672657175656e63794361704c6576656c456e756d2e4672657175656e63794361704c6576656c12620a0a6576656e745f7479706518032001280e324e2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e4672657175656e63794361704576656e7454797065456e756d2e4672657175656e63794361704576656e7454797065125f0a0974696d655f756e697418022001280e324c2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e4672657175656e637943617054696d65556e6974456e756d2e4672657175656e637943617054696d65556e697412180a0b74696d655f6c656e6774681805200128054800880101420e0a0c5f74696d655f6c656e67746842ec010a22636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e636f6d6d6f6e42114672657175656e637943617050726f746f50015a44676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f636f6d6d6f6e3b636f6d6d6f6ea20203474141aa021e476f6f676c652e4164732e476f6f676c654164732e56362e436f6d6d6f6eca021e476f6f676c655c4164735c476f6f676c654164735c56365c436f6d6d6f6eea0222476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a436f6d6d6f6e620670726f746f33"
        ), true);
        static::$is_initialized = true;
    }
}

