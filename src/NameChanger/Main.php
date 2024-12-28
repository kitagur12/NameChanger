<?php

namespace NameChanger;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
    }

    public function join(PlayerJoinEvent $event): void
    {
        $config = $this->getConfig();
        $player = $event->getPlayer();
        $special = $config->get("special_players", []);
        $playername = $player->getName();
        if (in_array($playername, $special)) {
            $name = $config->get("special_name", "<player>");
        } else {
            $name = $config->get("defalt_name", "<player>");
        }
        $name = str_replace("<player>", $playername, $name);
        $player->setNameTag($name); //setDisplayName
    }
}
