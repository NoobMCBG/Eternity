<?php

namespace NoobMCBG\Eternity\task;

use pocketmine\scheduler\Task;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use NoobMCBG\Eternity\Main as Eternity;
class OffTask extends Task{

    public function __construct(Eternity $plugin)
    {
        $this->plugin = $plugin;
    }
    public function getPlugin(){
    return $this->plugin;
    }
    public function onRun($currenttick){
        if(count($this->getPlugin()->cooldown->getAll()) >= 1){
            foreach($this->getPlugin()->cooldown->getAll() as $player => $cooldown){
                if($cooldown == 0){
                    $all = $this->getPlugin()->cooldown->getAll();
                    unset($all[$player]);
                    $this->getPlugin()->cooldown->setAll($all);
                    $this->getPlugin()->config->set($player, 'off');
                    if($this->getPlugin()->getServer()->getPlayer($player) !== null){
                        $this->getPlugin()->getServer()->getPlayer($player)->sendMessage("§l§e Kĩ Năng Eternity Của Bạn Đã Hết Thời Gian Sử Dụng");
                    }
                    continue;
                }
                if($this->getPlugin()->getServer()->getPlayer($player) !== null){
                }
                $this->getPlugin()->cooldown->set($player, $cooldown -1);
            }
            $this->getPlugin()->cooldown->save();
            $this->getPlugin()->config->save();
        }
    }
}