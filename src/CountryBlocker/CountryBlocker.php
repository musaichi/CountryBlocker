<?php

namespace CountryBlocker;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\utils\Config;

class CountryBlocker extends pluginBase implements Listener{

    public function onEnable() {
        if (!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0755, true);
        $c = new Config($this->getDataFolder()."country.yml", Config::YAML, array(
            "cn" => true,
            "in" => true,
            "sy" => true,
            "so" => true,
            "kr" => true,
            ));
        $c->save();
        $this->c = $c->getAll();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->reason = [
        	"cn" => "§a你因为安全高风险国家的国家，一直踢。",
        	"in" => "§aक्योंकि सुरक्षा के उच्च जोखिम वाले देशों के अपने देश, लात कर दिया गया है",
        	"sy" => "§aكان بلدكم بسبب الدول عالية المخاطر الأمنية، ركلة.",
        	"so" => "Your dalka sababtoo ah dalalka khatarta sare ammaanka, ayaa laad",
        	"kr" => "당신의 나라는 보안 위험이 높은 국가이기 때문에, kick되었습니다."
        ];
    }

    public function onPreLogin(PlayerPreLoginEvent $event){
        $p = $event->getPlayer();
        $i = $p->getAddress();
        $co = geoip_country_code_by_name($i);
        if($this->c[$co]){
        	$p->close("", $this->reason[$co]);
        	$event->setCancelled(true);
        }
    }

}
