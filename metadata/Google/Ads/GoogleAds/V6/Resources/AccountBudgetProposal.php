<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v6/resources/account_budget_proposal.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V6\Resources;

class AccountBudgetProposal
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Http::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Api\FieldBehavior::initOnce();
        \GPBMetadata\Google\Api\Resource::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0a90040a42676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6163636f756e745f6275646765745f70726f706f73616c5f7374617475732e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7322aa010a1f4163636f756e7442756467657450726f706f73616c537461747573456e756d2286010a1b4163636f756e7442756467657450726f706f73616c537461747573120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e1001120b0a0750454e44494e47100212110a0d415050524f5645445f48454c441003120c0a08415050524f5645441004120d0a0943414e43454c4c45441005120c0a0852454a4543544544100642f5010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7342204163636f756e7442756467657450726f706f73616c53746174757350726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330ae9030a40676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6163636f756e745f6275646765745f70726f706f73616c5f747970652e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732287010a1d4163636f756e7442756467657450726f706f73616c54797065456e756d22660a194163636f756e7442756467657450726f706f73616c54797065120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e1001120a0a064352454154451002120a0a06555044415445100312070a03454e441004120a0a0652454d4f5645100542f3010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d73421e4163636f756e7442756467657450726f706f73616c5479706550726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330aa8030a37676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f7370656e64696e675f6c696d69745f747970652e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7322580a155370656e64696e674c696d697454797065456e756d223f0a115370656e64696e674c696d697454797065120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e1001120c0a08494e46494e495445100242eb010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d7342165370656e64696e674c696d69745479706550726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330a8b030a2d676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f74696d655f747970652e70726f746f121d676f6f676c652e6164732e676f6f676c656164732e76362e656e756d73224e0a0c54696d6554797065456e756d223e0a0854696d6554797065120f0a0b554e5350454349464945441000120b0a07554e4b4e4f574e100112070a034e4f571002120b0a07464f5245564552100342e2010a21636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d73420d54696d655479706550726f746f50015a42676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f656e756d733b656e756d73a20203474141aa021d476f6f676c652e4164732e476f6f676c654164732e56362e456e756d73ca021d476f6f676c655c4164735c476f6f676c654164735c56365c456e756d73ea0221476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a456e756d73620670726f746f330af4130a3f676f6f676c652f6164732f676f6f676c656164732f76362f7265736f75726365732f6163636f756e745f6275646765745f70726f706f73616c2e70726f746f1221676f6f676c652e6164732e676f6f676c656164732e76362e7265736f75726365731a40676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f6163636f756e745f6275646765745f70726f706f73616c5f747970652e70726f746f1a37676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f7370656e64696e675f6c696d69745f747970652e70726f746f1a2d676f6f676c652f6164732f676f6f676c656164732f76362f656e756d732f74696d655f747970652e70726f746f1a1f676f6f676c652f6170692f6669656c645f6265686176696f722e70726f746f1a19676f6f676c652f6170692f7265736f757263652e70726f746f1a1c676f6f676c652f6170692f616e6e6f746174696f6e732e70726f746f22f70e0a154163636f756e7442756467657450726f706f73616c124d0a0d7265736f757263655f6e616d651801200128094236e04105fa41300a2e676f6f676c656164732e676f6f676c65617069732e636f6d2f4163636f756e7442756467657450726f706f73616c12140a0269641819200128034203e04103480588010112490a0d62696c6c696e675f7365747570181a20012809422de04105fa41270a25676f6f676c656164732e676f6f676c65617069732e636f6d2f42696c6c696e6753657475704806880101124b0a0e6163636f756e745f627564676574181b20012809422ee04105fa41280a26676f6f676c656164732e676f6f676c65617069732e636f6d2f4163636f756e74427564676574480788010112720a0d70726f706f73616c5f7479706518042001280e32562e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e4163636f756e7442756467657450726f706f73616c54797065456e756d2e4163636f756e7442756467657450726f706f73616c547970654203e04105126f0a06737461747573180f2001280e325a2e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e4163636f756e7442756467657450726f706f73616c537461747573456e756d2e4163636f756e7442756467657450726f706f73616c5374617475734203e04103121f0a0d70726f706f7365645f6e616d65181c200128094203e041054808880101122a0a18617070726f7665645f73746172745f646174655f74696d65181e200128094203e04103480988010112300a1e70726f706f7365645f70757263686173655f6f726465725f6e756d6265721823200128094203e04105480a88010112200a0e70726f706f7365645f6e6f7465731824200128094203e04105480b88010112240a126372656174696f6e5f646174655f74696d651825200128094203e04103480c88010112240a12617070726f76616c5f646174655f74696d651826200128094203e04103480d88010112270a1870726f706f7365645f73746172745f646174655f74696d65181d200128094203e041054800125d0a1870726f706f7365645f73746172745f74696d655f7479706518072001280e32342e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e54696d6554797065456e756d2e54696d65547970654203e04105480012250a1670726f706f7365645f656e645f646174655f74696d65181f200128094203e041054801125b0a1670726f706f7365645f656e645f74696d655f7479706518092001280e32342e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e54696d6554797065456e756d2e54696d65547970654203e04105480112250a16617070726f7665645f656e645f646174655f74696d651820200128094203e041034802125b0a16617070726f7665645f656e645f74696d655f7479706518162001280e32342e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e54696d6554797065456e756d2e54696d65547970654203e041034802122d0a1e70726f706f7365645f7370656e64696e675f6c696d69745f6d6963726f731821200128034203e04105480312730a1c70726f706f7365645f7370656e64696e675f6c696d69745f74797065180b2001280e32462e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e5370656e64696e674c696d697454797065456e756d2e5370656e64696e674c696d6974547970654203e041054803122d0a1e617070726f7665645f7370656e64696e675f6c696d69745f6d6963726f731822200128034203e04103480412730a1c617070726f7665645f7370656e64696e675f6c696d69745f7479706518182001280e32462e676f6f676c652e6164732e676f6f676c656164732e76362e656e756d732e5370656e64696e674c696d697454797065456e756d2e5370656e64696e674c696d6974547970654203e0410348043a8001ea417d0a2e676f6f676c656164732e676f6f676c65617069732e636f6d2f4163636f756e7442756467657450726f706f73616c124b637573746f6d6572732f7b637573746f6d65725f69647d2f6163636f756e7442756467657450726f706f73616c732f7b6163636f756e745f6275646765745f70726f706f73616c5f69647d42150a1370726f706f7365645f73746172745f74696d6542130a1170726f706f7365645f656e645f74696d6542130a11617070726f7665645f656e645f74696d6542190a1770726f706f7365645f7370656e64696e675f6c696d697442190a17617070726f7665645f7370656e64696e675f6c696d697442050a035f696442100a0e5f62696c6c696e675f736574757042110a0f5f6163636f756e745f62756467657442100a0e5f70726f706f7365645f6e616d65421b0a195f617070726f7665645f73746172745f646174655f74696d6542210a1f5f70726f706f7365645f70757263686173655f6f726465725f6e756d62657242110a0f5f70726f706f7365645f6e6f74657342150a135f6372656174696f6e5f646174655f74696d6542150a135f617070726f76616c5f646174655f74696d654287020a25636f6d2e676f6f676c652e6164732e676f6f676c656164732e76362e7265736f7572636573421a4163636f756e7442756467657450726f706f73616c50726f746f50015a4a676f6f676c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c656164732f76362f7265736f75726365733b7265736f7572636573a20203474141aa0221476f6f676c652e4164732e476f6f676c654164732e56362e5265736f7572636573ca0221476f6f676c655c4164735c476f6f676c654164735c56365c5265736f7572636573ea0225476f6f676c653a3a4164733a3a476f6f676c654164733a3a56363a3a5265736f7572636573620670726f746f33"
        ), true);
        static::$is_initialized = true;
    }
}

