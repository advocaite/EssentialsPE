<?php
namespace EssentialsPE\Commands;

use EssentialsPE\BaseCommand;
use EssentialsPE\Loader;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class Burn extends BaseCommand{
    public function __construct(Loader $plugin){
        parent::__construct($plugin, "burn", "Set a player on fire", "/burn <player> <seconds>");
        $this->setPermission("essentials.burn");
    }

    public function execute(CommandSender $sender, $alias, array $args){
        if(!$this->testPermission($sender)){
            return false;
        }
        if(count($args) != 2){
            $sender->sendMessage(TextFormat::RED . $this->getUsage());
            return false;
        }
        $player = $this->getPlugin()->getPlayer($args[0]);
        $time = $args[1];
        if(!$player){
            $sender->sendMessage(TextFormat::RED . "[Error] Player not found");
            return false;
        }
        if(!is_numeric($time)){
            $sender->sendMessage(TextFormat::RED . "[Error] Invalid time");
        }else{
            $player->setOnFire($time);
            $sender->sendMessage(TextFormat::YELLOW . "$args[0] is now on fire!");
        }
        return true;
    }
}
