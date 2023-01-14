<?php


namespace Paroki\Tests\Behat;


use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\JsonContext;
use Behatch\Context\RestContext;
use Behatch\Json\Json;
use Paroki\Referensi\Entity\Keuskupan;
use Paroki\Referensi\Entity\Paroki;
use Paroki\Referensi\KeuskupanManager;
use Paroki\Referensi\ParokiManager;
use Paroki\User\Entity\User;

class ReferensiContext implements Context
{
    /**
     * @var KeuskupanManager
     */
    private KeuskupanManager $keuskupan;
    private RestContext $restContext;
    private JsonContext $jsonContext;
    /**
     * @var ParokiManager
     */
    private ParokiManager $paroki;

    public function __construct(
        KeuskupanManager $keuskupan,
        ParokiManager $paroki
    )
    {
        $this->keuskupan = $keuskupan;
        $this->paroki = $paroki;
    }

    /**
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $env = $scope->getEnvironment();

        $this->restContext = $env->getContext(RestContext::class);
        $this->jsonContext = $env->getContext(JsonContext::class);
    }

    /**
     * @Given I don't have keuskupan :nama
     */
    public function iDonTHaveKeuskupan(string $nama): void
    {
        $manager = $this->keuskupan;

        $keuskupan = $manager->findByNama($nama);

        if(!is_null($keuskupan)){
            $manager->remove($keuskupan);
        }
    }

    /**
     * @Given I send :method request to keuskupan with:
     */
    public function iSendARequestToKeuskupan(string $method, ?PyStringNode $body = null): void
    {
        $rest = $this->restContext;

        $rest->iSendARequestToWithBody($method, '/api/keuskupan', $body);
    }

    /**
     * @Given I have keuskupan with kode :kode and nama :nama
     */
    public function iHaveKeuskupanWithKodeAndNama(string $kode, string $nama): Keuskupan
    {
        $manager = $this->keuskupan;

        $keuskupan = $manager->findByNama($nama);
        if(is_null($keuskupan)){
            $keuskupan = new Keuskupan();
            $keuskupan
                ->setKode($kode)
                ->setNama($nama)
            ;
            $manager->save($keuskupan);
        }

        return $keuskupan;
    }

    /**
     * @Given I send a :method request to keuskupan :nama
     * @Given I send a :method request to keuskupan :nama with body:
     */
    public function iHaveSendRequestToUpdateKeuskupan(string $method, string $nama, ?PyStringNode $body=null)
    {
        $rest = $this->restContext;
        $keuskupan = $this->keuskupan->findByNama($nama);

        $rest->iSendARequestTo($method, '/api/keuskupan/'.$keuskupan->getId(), $body);
    }

    /**
     * @Given I don't have paroki :nama
     */
    public function iDonTHaveParoki(string $nama): void
    {
        $manager = $this->paroki;
        $paroki = $manager->findByNama($nama);

        if($paroki instanceof Paroki){
            $manager->remove($paroki);
        }
    }

    /**
     * @Given I have paroki with kode :kode and nama :nama
     */
    public function iHaveParokiWith(string $kode, string $nama)
    {
        $manager = $this->paroki;
        $paroki = $manager->findByNama($nama);

        if(!$paroki instanceof Paroki){
            $paroki = new Paroki();
        }

        $paroki
            ->setKode($kode)
            ->setNama($nama)
            ->setGereja($nama)
        ;
        $manager->save($paroki);
    }

    /**
     * @Given I send a :method request to paroki :nama
     * @Given I send a :method request to paroki :nama with body:
     */
    public function iHaveSendRequestToParoki(string $method, string $nama, ?PyStringNode $body=null)
    {
        $rest = $this->restContext;
        $paroki = $this->paroki->findByNama($nama);

        $rest->iSendARequestTo($method, '/api/paroki/'.$paroki->getId(), $body);
    }
}