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
));
$this->c->save();
$this->getServer()->getPluginManager()->registerEvents($this, $this);
}

public function onPreLogin(PlayerPreLoginEvent $event){
$p = $event->getPlayer();
$i = $p->getAddress();
$co = geoip_country_code_by_name($i);
if($this->c->cn = true){
if($co = cn){
$p->close("","§a");
}
}
}
}
