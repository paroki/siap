<?php


namespace Paroki\Tests\Behat;


use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\JsonContext;
use Behatch\Context\RestContext;
use Behatch\Json\Json;
use Paroki\Referensi\Entity\Keuskupan;
use Paroki\Referensi\KeuskupanManager;
use Paroki\User\Entity\User;

class ReferensiContext implements Context
{
    /**
     * @var KeuskupanManager
     */
    private KeuskupanManager $keuskupan;
    private RestContext $restContext;
    private JsonContext $jsonContext;

    public function __construct(KeuskupanManager $keuskupan)
    {
        $this->keuskupan = $keuskupan;
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

        $rest->iSendARequestToWithBody($method, '/keuskupan', $body);
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
     * @Given I have send a :method request to keuskupan :nama
     * @Given I have send a :method request to keuskupan :nama with body:
     */
    public function iHaveSendRequestToUpdateKeuskupan(string $method, string $nama, ?PyStringNode $body=null)
    {
        $rest = $this->restContext;
        $keuskupan = $this->keuskupan->findByNama($nama);

        $rest->iSendARequestTo($method, '/keuskupan/'.$keuskupan->getId(), $body);
    }
}