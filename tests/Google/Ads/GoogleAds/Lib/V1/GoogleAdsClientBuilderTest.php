<?php

/*
 * Copyright 2018 Google LLC
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

namespace Google\Ads\GoogleAds\Lib\V1;

use Google\Ads\GoogleAds\Lib\Configuration;
use Google\Ads\GoogleAds\Lib\ConfigurationLoader;
use Google\Ads\GoogleAds\Lib\Testing\ConfigurationLoaderTestProvider;
use Google\Ads\GoogleAds\Util\EnvironmentalVariables;
use Google\Auth\FetchAuthTokenInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Unit tests for `GoogleAdsClientBuilder`.
 *
 * @covers \Google\Ads\GoogleAds\Lib\V1\GoogleAdsClientBuilder
 * @small
 */
class GoogleAdsClientBuilderTest extends TestCase
{

    private static $DEVELOPER_TOKEN = 'ABcdeFGH93KL-NOPQ_STUv';
    private static $LOGIN_CUSTOMER_ID = '1234567890';

    /** @var GoogleAdsClientBuilder $googleAdsClientBuilder */
    private $googleAdsClientBuilder;
    /** @var FetchAuthTokenInterface $fetchAuthTokenInterfaceMock */
    private $fetchAuthTokenInterfaceMock;
    /** @var LoggerInterface $loggerMock */
    private $loggerMock;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    protected function setUp()
    {
        $this->googleAdsClientBuilder = new GoogleAdsClientBuilder();
        $this->fetchAuthTokenInterfaceMock = $this
            ->getMockBuilder(FetchAuthTokenInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->loggerMock =
            $this->getMockBuilder(LoggerInterface::class)->disableOriginalConstructor()->getMock();
    }

    public function testBuildClientFromConfiguration()
    {
        $valueMap = [
            /* Config name, section, value */
            ['developerToken', 'GOOGLE_ADS', self::$DEVELOPER_TOKEN],
            ['loginCustomerId', 'GOOGLE_ADS', self::$LOGIN_CUSTOMER_ID],
            ['endpoint', 'GOOGLE_ADS', 'https://abc.xyz:443'],
            ['proxy', 'CONNECTION', 'https://localhost:8080']
        ];
        $configurationMock = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configurationMock->expects($this->any())
            ->method('getConfiguration')
            ->will($this->returnValueMap($valueMap));

        $googleAdsClient = $this->googleAdsClientBuilder
            ->from($configurationMock)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->withLogger($this->loggerMock)
            ->build();

        $this->assertSame(self::$DEVELOPER_TOKEN, $googleAdsClient->getDeveloperToken());
        $this->assertSame(self::$LOGIN_CUSTOMER_ID, $googleAdsClient->getLoginCustomerId());
        $this->assertSame('https://abc.xyz:443', $googleAdsClient->getEndpoint());
        $this->assertSame('https://localhost:8080', $googleAdsClient->getProxy());
        $this->assertSame($this->loggerMock, $googleAdsClient->getLogger());
    }

    public function testBuildFromDefaults()
    {
        $valueMap = [
            ['developerToken', 'GOOGLE_ADS', self::$DEVELOPER_TOKEN]
        ];
        $configurationMock = $this->getMockBuilder(Configuration::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configurationMock->expects($this->any())
            ->method('getConfiguration')
            ->will($this->returnValueMap($valueMap));

        $googleAdsClient = $this->googleAdsClientBuilder
            ->from($configurationMock)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();

        $this->assertSame(self::$DEVELOPER_TOKEN, $googleAdsClient->getDeveloperToken());
    }

    public function testBuildFromFile()
    {
        $environmentalVariablesMock = $this
            ->getMockBuilder(EnvironmentalVariables::class)
            ->getMock();
        $environmentalVariablesMock
            ->method('getHome')
            ->willReturn(ConfigurationLoaderTestProvider::getFilePathToFakeHome());
        $configurationLoader = new ConfigurationLoader($environmentalVariablesMock);

        $googleAdsClientBuilder = new GoogleAdsClientBuilder($configurationLoader);
        $googleAdsClient = $googleAdsClientBuilder
            ->fromFile('home_google_ads_php.ini')
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->build();

        $this->assertSame(self::$DEVELOPER_TOKEN, $googleAdsClient->getDeveloperToken());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFailsWithoutDeveloperToken()
    {
        $this->googleAdsClientBuilder
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFailsWithInvalidEndpointUrl()
    {
        $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withEndpoint('http://:999')
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFailsWithoutOAuth2Credential()
    {
        $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->build();
    }

    /**
     * @dataProvider provideInvalidProxyURIs
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFailsWithInvalidProxyUri($invalidProxyUri)
    {
        $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withProxy($invalidProxyUri)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();
    }

    public function provideInvalidProxyURIs()
    {
        return [
            ['foo'],
            ['http://'],
            ['foo.com'],
            ['http://.com']
        ];
    }

    public function testBuild()
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withLoginCustomerId(self::$LOGIN_CUSTOMER_ID)
            ->withEndpoint('abc.xyz.com')
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();

        $this->assertSame(self::$DEVELOPER_TOKEN, $googleAdsClient->getDeveloperToken());
        $this->assertSame(self::$LOGIN_CUSTOMER_ID, $googleAdsClient->getLoginCustomerId());
        $this->assertSame('abc.xyz.com', $googleAdsClient->getEndpoint());
        $this->assertInstanceOf(
            FetchAuthTokenInterface::class,
            $googleAdsClient->getOAuth2Credential()
        );
    }

    public function testBuildDefaults()
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();

        $this->assertSame(self::$DEVELOPER_TOKEN, $googleAdsClient->getDeveloperToken());
        $this->assertInstanceOf(
            FetchAuthTokenInterface::class,
            $googleAdsClient->getOAuth2Credential()
        );
    }

    public function testBuildWithLoginCustomerId()
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withLoginCustomerId(self::$LOGIN_CUSTOMER_ID)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();

        $this->assertSame(self::$LOGIN_CUSTOMER_ID, $googleAdsClient->getLoginCustomerId());
    }

    public function testBuildWithNullLoginCustomerId()
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withLoginCustomerId(null)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();
        $this->assertNull($googleAdsClient->getLoginCustomerId());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildWithNegativeLoginCustomerId()
    {
        $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withLoginCustomerId(-1)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();
    }

    /**
     * @dataProvider provideValidProxyURIs
     */
    public function testBuildWithValidProxyURIs(string $proxy)
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withProxy($proxy)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();

        $this->assertSame($proxy, $googleAdsClient->getProxy());
    }

    public function provideValidProxyURIs()
    {
        return [
            ['http://localhost:8080'],
            ['http://user:pass@localhost:8080'],
            ['https://localhost:8080'],
            ['https://user:pass@localhost:8080']
        ];
    }

    public function testBuildWithoutLogLevelSetsDefault()
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->build();

        $this->assertSame(LogLevel::INFO, $googleAdsClient->getLogLevel());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildWithInvalidLogLevelThrowsException()
    {
        $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->withLogLevel("banana")
            ->build();
    }

    public function testBuildWithLowercaseLogLevel()
    {
        $googleAdsClient = $this->googleAdsClientBuilder
            ->withDeveloperToken(self::$DEVELOPER_TOKEN)
            ->withOAuth2Credential($this->fetchAuthTokenInterfaceMock)
            ->withLogLevel("debug")
            ->build();

        $this->assertSame(LogLevel::DEBUG, $googleAdsClient->getLogLevel());
    }
}
