<?php

/*
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Ads\GoogleAds\Util\V6;

use Google\Protobuf\Any;
use Google\Rpc\Status;
use Google\Ads\GoogleAds\V6\Errors\GoogleAdsError;
use Google\Ads\GoogleAds\V6\Errors\GoogleAdsFailure;
use PHPUnit\Framework\TestCase;

class GoogleAdsFailuresTest extends TestCase
{
    public function testFromAny()
    {
        $any = new Any();
        $any->pack(new GoogleAdsFailure());

        $this->assertInstanceOf(GoogleAdsFailure::class, GoogleAdsFailures::fromAny($any));
    }

    public function testFromAnyContainingInvalidTypeWillThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $any = new Any();
        $any->pack(new GoogleAdsError());

        GoogleAdsFailures::fromAny($any);
    }

    public function testFromEmptyStatus()
    {
        $this->assertCount(0, GoogleAdsFailures::fromStatus(new Status()));
    }

    public function testFromStatusWithSingleFailure()
    {
        $any = new Any();
        $any->pack(new GoogleAdsFailure());

        $status = new Status(['details' => [$any]]);
        $failures = GoogleAdsFailures::fromStatus($status);
        $this->assertCount(1, $failures);
        $this->assertInstanceOf(GoogleAdsFailure::class, $failures[0]);
    }
}
