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
        	"en" => true,
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
        	"en" => "§aYou are not allowed to get in as of your living country",
        	"cn" => "§a你因为安全高风险国家的国家，一直踢。",
        	"in" => "§aक्योंकि सुरक्षा के उच्च जोखिम वाले देशों के अपने देश, लात कर दिया गया है",
        	"sy" => "§aكان بلدكم بسبب الدول عالية المخاطر الأمنية، ركلة.",
        	"so" => "§aYour dalka sababtoo ah dalalka khatarta sare ammaanka, ayaa laad",
        	"kr" => "§a당신의 나라는 보안 위험이 높은 국가이기 때문에, kick되었습니다."
        ];
    }

    public function onPreLogin(PlayerPreLoginEvent $event){
        $p = $event->getPlayer();
        $i = $p->getAddress();
        $co = geoip_country_code_by_name($i);
<<<<<<< HEAD
        if($this->c[$co]){
        	$p->close("", $this->reason[$co]);
        	$event->setCancelled(true);
=======
        if($this->c->cn == true && $co == cn){
            $p->close("", "§a你因为安全高风险国家的国家，一直踢。");
        }
        if($this->c->in == true && $co == in){
            $p->close("", "§aक्योंकि सुरक्षा के उच्च जोखिम वाले देशों के अपने देश, लात कर दिया गया है");
        }
        if($this->c->sy == true && $co == sy){
            $p->close("", "§aكان بلدكم بسبب الدول عالية المخاطر الأمنية، ركلة.");
        }
        if($this->c->so == true && $c == so){
            $p->close("", "Your dalka sababtoo ah dalalka khatarta sare ammaanka, ayaa laad");
        }
        if($this->c->kr == true && $c == kr){
            $p->close("", "당신의 나라는 보안 위험이 높은 국가이기 때문에, kick되었습니다.");
>>>>>>> refs/remotes/musaichi/master
        }
    }
}
