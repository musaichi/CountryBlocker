<?php

namespace CountryBlocker;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\textFormat;
use pocketmine\utils\Config;

class CountryBlocker extends pluginBase implements Listener{

    public function onEnable() {
        if (!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0755, true);
        $this->c = new Config($this->getDataFolder()."country.yml", Config::YAML, array(
            "cn" => true,
            "in" => true,
            "sy" => true,
            "so" => true,
            "kr" => true,
            ));
        $this->c->save();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPreLogin(PlayerPreLoginEvent $event){
        $p = $event->getPlayer();
        $i = $p->getAddress();
        $co = geoip_country_code_by_name($i);
        if($this->c->cn == true){
            if($co == cn){
                $p->close("", "§a你因为安全高风险国家的国家，一直踢。");
            }
        }
        if($this->c->in == true){
            if($co == in){
                $p->close("", "§aक्योंकि सुरक्षा के उच्च जोखिम वाले देशों के अपने देश, लात कर दिया गया है");
            }
        }
        if($this->c->sy == true){
            if($co == sy){
                $p->close("", "§aكان بلدكم بسبب الدول عالية المخاطر الأمنية، ركلة.");
            }
        }
        if($this->c->so == true){
            if($c == so){
                $p->close("", "Your dalka sababtoo ah dalalka khatarta sare ammaanka, ayaa laad");
            }
        }
        if($this->c->kr == true){
            if($c == kr){
                $p->close("", "당신의 나라는 보안 위험이 높은 국가이기 때문에, kick되었습니다.");
            }
        }
    }

}
