<?php
use PHPUnit\Framework\TestCase;
use Domain\ValueObject\Currency;
use Domain\ValueObject\Money;
use Domain\Service\ExchangeService;
use Infrastructure\Repository\InMemoryExchangeRateRepository;
use Domain\ValueObject\CurrencyEnum;

class ExchangeServiceTest extends TestCase
{
    private ExchangeService $exchangeService;

    protected function setUp(): void
    {
        $rateRepository = new InMemoryExchangeRateRepository();
        $this->exchangeService = new ExchangeService($rateRepository, 0.01);
    }

    public function testSellEURForGBP()
    {
        $eur = new Currency(CurrencyEnum::EUR);
        $gbp = new Currency(CurrencyEnum::GBP);
        $sellAmount = new Money(10000, $eur);

        $receivedGbp = $this->exchangeService->sell($sellAmount, $gbp);

        $this->assertEquals(15834, $receivedGbp->getAmount());
        $this->assertEquals(CurrencyEnum::GBP, $receivedGbp->getCurrency()->getCode());
    }

    public function testBuyGBPWithEUR()
    {
        $eur = new Currency(CurrencyEnum::EUR);
        $gbp = new Currency(CurrencyEnum::GBP);
        $buyAmount = new Money(10000, $gbp);

        $paidEur = $this->exchangeService->buy($buyAmount, $eur);

        $this->assertEquals(15521, $paidEur->getAmount());
        $this->assertEquals(CurrencyEnum::EUR, $paidEur->getCurrency()->getCode());
    }

    public function testSellGBPForEUR()
    {
        $gbp = new Currency(CurrencyEnum::GBP);
        $eur = new Currency(CurrencyEnum::EUR);
        $sellAmount = new Money(10000, $gbp);

        $receivedEur = $this->exchangeService->sell($sellAmount, $eur);

        $this->assertEquals(15586, $receivedEur->getAmount());
        $this->assertEquals(CurrencyEnum::EUR, $receivedEur->getCurrency()->getCode());
    }

    public function testBuyEURWithGBP()
    {
        $gbp = new Currency(CurrencyEnum::GBP);
        $eur = new Currency(CurrencyEnum::EUR);
        $buyAmount = new Money(10000, $eur);

        $paidGbp = $this->exchangeService->buy($buyAmount, $gbp);

        $this->assertEquals(15277, $paidGbp->getAmount());
        $this->assertEquals(CurrencyEnum::GBP, $paidGbp->getCurrency()->getCode());
    }
}
