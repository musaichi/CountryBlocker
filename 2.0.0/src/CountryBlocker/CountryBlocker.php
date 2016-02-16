<?php

namespace CountryBlocker;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\utils\Config;

class CountryBlocker extends pluginBase implements Listener{

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0755, true);
        $this->country = new Config($this->getDataFolder()."country.yml", Config::YAML, array(
            "en" => false,
            "us" => false,
            "fr" => false,
            "cn" => true,
            "in" => true,
            "sy" => true,
            "so" => true,
            "kr" => true,
            "ru" => true,
            ));
        $this->country->save();
        $this->reason = [
            "en" => "§aYou are not allowed to get in as of your living country",
            "us" => "§aYou are not allowed to get in as of your living country",
            "fr" => "§aYou are not allowed to get in as of your living country",
            "cn" => "§a你因为安全高风险国家的国家，一直踢。",
            "in" => "§aक्योंकि सुरक्षा के उच्च जोखिम वाले देशों के अपने देश, लात कर दिया गया है",
            "sy" => "§aكان بلدكم بسبب الدول عالية المخاطر الأمنية، ركلة.",
            "so" => "§aYour dalka sababtoo ah dalalka khatarta sare ammaanka, ayaa laad",
            "kr" => "§a당신의 나라는 보안 위험이 높은 국가이기 때문에, kick되었습니다.",
            "ru" => "§aВы не можете войти из вашей страны.",
            ];
    }

    public function onPreLogin(PlayerPreLoginEvent $event){
        $p = $event->getPlayer();
        $i = $p->getAddress();
        $location = json_decode(file_get_contents('http://ip-api.com/json/', $i));
        $c = $location->countryCode;
        if($this->country->get($c) == true){
            $p->close("", $this->reason[$c]);
            $event->setCancelled(true);
        }
    }
}
