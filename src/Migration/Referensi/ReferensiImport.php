<?php


namespace Paroki\Migration\Referensi;


use Paroki\Referensi\Entity\Keuskupan;
use Paroki\Referensi\Entity\Paroki;
use Paroki\Referensi\KeuskupanManager;
use Paroki\Referensi\ParokiManager;

class ReferensiImport
{
    /**
     * @var KeuskupanManager
     */
    private KeuskupanManager $keuskupan;
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

    public function start(): void
    {
        $this->importKeuskupan();
        $this->importParoki();
    }

    private function importKeuskupan(): void
    {
        $manager = $this->keuskupan;
        $file = __DIR__.'/../Resources/csv/keuskupan.csv';
        $handle = fopen($file, 'r');

        $num = 0;
        while(($data = fgetcsv($handle, filesize($file))) !== false){
            if(0 === $num){
                $num++;
                continue;
            }

            $keuskupan = $manager->findByNama($data[2]);

            if(is_null($keuskupan)){
                $keuskupan = new Keuskupan();
            }

            $keuskupan
                ->setKode($data[0])
                ->setNomor($data[1])
                ->setNama($data[2])
                ->setNamaLatin($data[3])
                ->setAlamat($data[4])
                ->setKota($data[5])
                ->setTelepon($data[6])
                ->setFax($data[7])
                ->setWebsite($data[8])
                ->setEmail($data[9])
                ->setUskup($data[10]);

            $manager->save($keuskupan);
            $num++;
        }
    }

    private function importParoki(): void
    {
        $file = __DIR__.'/../Resources/csv/paroki.csv';
        $handle = fopen($file, 'r');

        $headParsed = false;
        while(($data = fgetcsv($handle, filesize($file))) !== false){
            if(false === $headParsed){
                $headParsed = true;
                continue;
            }
            $this->processParoki($data);
        }
    }

    private function processParoki(array $data): void
    {
        $manager = $this->paroki;
        $paroki = $manager->findByNama($data[3]);
        $keuskupan = $this->keuskupan->findByKode($data[1]);

        if(!$paroki instanceof Paroki){
            $paroki = new Paroki();
        }

        $paroki
            ->setKode($data[0])
            ->setKeuskupan($keuskupan)
            ->setNomor($data[2])
            ->setNama($data[3])
            ->setGereja($data[4])
            ->setAlamat($data[5])
            ->setKota($data[6])
            ->setTelepon($data[7])
            ->setFax($data[8])
            ->setWebsite($data[9])
            ->setEmail($data[10])
            ->setPastorParoki($data[11])
            ->setWilayahKeuskupan($data[12])
        ;
        $manager->save($paroki);
    }
}