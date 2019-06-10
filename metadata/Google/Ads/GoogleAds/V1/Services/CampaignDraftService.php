<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v1/services/campaign_draft_service.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V1\Services;

class CampaignDraftService
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Ads\GoogleAds\V1\Resources\CampaignDraft::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        \GPBMetadata\Google\Longrunning\Operations::initOnce();
        \GPBMetadata\Google\Protobuf\FieldMask::initOnce();
        \GPBMetadata\Google\Protobuf\Wrappers::initOnce();
        \GPBMetadata\Google\Rpc\Status::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0a9d120a3d676f6f676c652f6164732f676f6f676c656164732f76312f73" .
            "657276696365732f63616d706169676e5f64726166745f73657276696365" .
            "2e70726f746f1220676f6f676c652e6164732e676f6f676c656164732e76" .
            "312e73657276696365731a1c676f6f676c652f6170692f616e6e6f746174" .
            "696f6e732e70726f746f1a23676f6f676c652f6c6f6e6772756e6e696e67" .
            "2f6f7065726174696f6e732e70726f746f1a20676f6f676c652f70726f74" .
            "6f6275662f6669656c645f6d61736b2e70726f746f1a1e676f6f676c652f" .
            "70726f746f6275662f77726170706572732e70726f746f1a17676f6f676c" .
            "652f7270632f7374617475732e70726f746f22300a1747657443616d7061" .
            "69676e44726166745265717565737412150a0d7265736f757263655f6e61" .
            "6d6518012001280922b0010a1b4d757461746543616d706169676e447261" .
            "6674735265717565737412130a0b637573746f6d65725f69641801200128" .
            "09124c0a0a6f7065726174696f6e7318022003280b32382e676f6f676c65" .
            "2e6164732e676f6f676c656164732e76312e73657276696365732e43616d" .
            "706169676e44726166744f7065726174696f6e12170a0f7061727469616c" .
            "5f6661696c75726518032001280812150a0d76616c69646174655f6f6e6c" .
            "7918042001280822350a1b50726f6d6f746543616d706169676e44726166" .
            "745265717565737412160a0e63616d706169676e5f647261667418012001" .
            "280922f0010a1643616d706169676e44726166744f7065726174696f6e12" .
            "2f0a0b7570646174655f6d61736b18042001280b321a2e676f6f676c652e" .
            "70726f746f6275662e4669656c644d61736b12420a066372656174651801" .
            "2001280b32302e676f6f676c652e6164732e676f6f676c656164732e7631" .
            "2e7265736f75726365732e43616d706169676e4472616674480012420a06" .
            "75706461746518022001280b32302e676f6f676c652e6164732e676f6f67" .
            "6c656164732e76312e7265736f75726365732e43616d706169676e447261" .
            "6674480012100a0672656d6f76651803200128094800420b0a096f706572" .
            "6174696f6e229f010a1c4d757461746543616d706169676e447261667473" .
            "526573706f6e736512310a157061727469616c5f6661696c7572655f6572" .
            "726f7218032001280b32122e676f6f676c652e7270632e53746174757312" .
            "4c0a07726573756c747318022003280b323b2e676f6f676c652e6164732e" .
            "676f6f676c656164732e76312e73657276696365732e4d75746174654361" .
            "6d706169676e4472616674526573756c7422320a194d757461746543616d" .
            "706169676e4472616674526573756c7412150a0d7265736f757263655f6e" .
            "616d6518012001280922630a234c69737443616d706169676e4472616674" .
            "4173796e634572726f72735265717565737412150a0d7265736f75726365" .
            "5f6e616d6518012001280912120a0a706167655f746f6b656e1802200128" .
            "0912110a09706167655f73697a6518032001280522630a244c6973744361" .
            "6d706169676e44726166744173796e634572726f7273526573706f6e7365" .
            "12220a066572726f727318012003280b32122e676f6f676c652e7270632e" .
            "53746174757312170a0f6e6578745f706167655f746f6b656e1802200128" .
            "0932e1060a1443616d706169676e44726166745365727669636512b9010a" .
            "1047657443616d706169676e447261667412392e676f6f676c652e616473" .
            "2e676f6f676c656164732e76312e73657276696365732e47657443616d70" .
            "6169676e4472616674526571756573741a302e676f6f676c652e6164732e" .
            "676f6f676c656164732e76312e7265736f75726365732e43616d70616967" .
            "6e4472616674223882d3e493023212302f76312f7b7265736f757263655f" .
            "6e616d653d637573746f6d6572732f2a2f63616d706169676e4472616674" .
            "732f2a7d12d5010a144d757461746543616d706169676e44726166747312" .
            "3d2e676f6f676c652e6164732e676f6f676c656164732e76312e73657276" .
            "696365732e4d757461746543616d706169676e4472616674735265717565" .
            "73741a3e2e676f6f676c652e6164732e676f6f676c656164732e76312e73" .
            "657276696365732e4d757461746543616d706169676e4472616674735265" .
            "73706f6e7365223e82d3e493023822332f76312f637573746f6d6572732f" .
            "7b637573746f6d65725f69643d2a7d2f63616d706169676e447261667473" .
            "3a6d75746174653a012a12ba010a1450726f6d6f746543616d706169676e" .
            "4472616674123d2e676f6f676c652e6164732e676f6f676c656164732e76" .
            "312e73657276696365732e50726f6d6f746543616d706169676e44726166" .
            "74526571756573741a1d2e676f6f676c652e6c6f6e6772756e6e696e672e" .
            "4f7065726174696f6e224482d3e493023e22392f76312f7b63616d706169" .
            "676e5f64726166743d637573746f6d6572732f2a2f63616d706169676e44" .
            "72616674732f2a7d3a70726f6d6f74653a012a12f7010a1c4c6973744361" .
            "6d706169676e44726166744173796e634572726f727312452e676f6f676c" .
            "652e6164732e676f6f676c656164732e76312e73657276696365732e4c69" .
            "737443616d706169676e44726166744173796e634572726f727352657175" .
            "6573741a462e676f6f676c652e6164732e676f6f676c656164732e76312e" .
            "73657276696365732e4c69737443616d706169676e44726166744173796e" .
            "634572726f7273526573706f6e7365224882d3e493024212402f76312f7b" .
            "7265736f757263655f6e616d653d637573746f6d6572732f2a2f63616d70" .
            "6169676e4472616674732f2a7d3a6c6973744173796e634572726f727342" .
            "80020a24636f6d2e676f6f676c652e6164732e676f6f676c656164732e76" .
            "312e7365727669636573421943616d706169676e44726166745365727669" .
            "636550726f746f50015a48676f6f676c652e676f6c616e672e6f72672f67" .
            "656e70726f746f2f676f6f676c65617069732f6164732f676f6f676c6561" .
            "64732f76312f73657276696365733b7365727669636573a20203474141aa" .
            "0220476f6f676c652e4164732e476f6f676c654164732e56312e53657276" .
            "69636573ca0220476f6f676c655c4164735c476f6f676c654164735c5631" .
            "5c5365727669636573ea0224476f6f676c653a3a4164733a3a476f6f676c" .
            "654164733a3a56313a3a5365727669636573620670726f746f33"
        ), true);

        static::$is_initialized = true;
    }
}
