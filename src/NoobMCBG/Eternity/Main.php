<?php

namespace NoobMCBG\Eternity;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\sound\Sound;

use pocketmine\scheduler\ClosureTask;
use libs\muqsit\invmenu\InvMenu;
use libs\muqsit\invmenu\InvMenuHandler;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;

use pocketmine\command\Command;
use pocketmine\command\Commandsender;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\item\Armor;

use NoobMCBG\Eternity\task\OffTask;

class Main extends PluginBase implements Listener {
    /** @var Config */
    private $cfg;
    /** @var Main */
    public static $api;
    public $cooldown;

    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->cooldown = new Config($this->getDataFolder() . "cooldown.yml", Config::YAML);
        $this->getScheduler()->scheduleRepeatingTask(new OffTask($this), 20 * 60);
        self::$api = $this;
        	    $this->eternity = InvMenu::create(InvMenu::TYPE_CHEST);
	    if(!InvMenuHandler::isRegistered()){
		      InvMenuHandler::register($this);
        }
    }

      public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool {   
        switch($cmd->getName()){
            case "eternity":
                if(!$sender instanceof Player){
                    $sender->sendMessage("§cPlease run command in-game");
                    return true;
                }
             if(!$sender->hasPermission("kingofblock.command")){
                 $sender->sendMessage("§l§cYou not permission to use command!");
             }
             $this->eternity($sender);
             break;
        }
             return true;
    }

    public static function getAPI(): Main {
        return self::$api;
    }	
    
    public function eternity($sender)
    {
    $this->eternity->readonly();
    $this->eternity->setListener([$this, "GuiListener"]);
    $this->eternity->setName("§l§2Skill Eternity");
	    $inventory = $this->eternity->getInventory();
	    $inventory->setItem(0, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(1, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(2, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(3, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(4, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(5, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(6, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(7, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(8, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(9, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(10, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(11, Item::get(35, 5, 1)->setCustomName("§l§aOn"));
	    $inventory->setItem(12, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(13, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(14, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(15, Item::get(35, 14, 1)->setCustomName("§l§cOff"));
	    $inventory->setItem(16, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(17, Item::get(160, 14, 1)->setCustomName("---"));
	    $inventory->setItem(18, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(19, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(20, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(21, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(22, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(23, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(24, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(25, Item::get(160, 14, 1)->setCustomName("---"));
        $inventory->setItem(26, Item::get(160, 14, 1)->setCustomName("---"));
	    $this->eternity->send($sender);
	}
	
    public function GuiListener(Player $sender, Item $item){
          $player = $sender->getPlayer();
          $hand = $sender->getInventory()->getItemInHand()->getCustomName();
         $inventory = $this->eternity->getInventory();
      if($item->getCustomName() === "§l§aOn"){
        $sender->removeWindow($inventory);
                    $sender->addTitle("§l§bEternity", "§l§aOn");
                    $sender->sendMessage("§l§bEternity §aOn");
                    $this->config->set(strtolower($player->getName()), "on");
                    $this->config->save();
                    $this->cooldown->set(strtolower($player->getName()), 60); //60 Min = 1 hours
                    $this->cooldown->save();
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_CLOSED);
      }
      if($item->getCustomName() === "§l§cOff"){
        $sender->removeWindow($inventory);
                    $sender->addTitle("§l§bEternity", "§l§cOff");
                    $sender->sendMessage("§l§bEternity§c Off");
                    $this->config->set(strtolower($player->getName()), "off");
                    $this->config->save();
                    $all = $this->cooldown->getAll();
                    unset($all[strtolower($player->getName())]);
                    $this->cooldown->setAll($all);
                    $this->cooldown->save();
                    $sender->getLevel()->broadcastLevelSoundEvent($sender->add(0, $sender->eyeHeight, 0), LevelSoundEventPacket::SOUND_CHEST_CLOSED);
      }
    }
}
