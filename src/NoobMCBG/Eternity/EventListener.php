<?php

namespace NoobMCBG\Eternity;

use pocketmine\Player;
use pocketmine\level\Level;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\block\block;
use pocketmine\event\block\BlockBreakEvent;

class EventListener implements Listener{

    public function onBlockBreak(BlockBreakEvent $event){
        if($event->isCancelled()){
            return false;
        } else{
        $player = $event->getPlayer();
        $isim = $player->getName();
        $block = $event->getBlock();
        $api = Main::getAPI();
        if($api->config->get(strtolower($isim)) == "on"){
              if($block->getId() == 14){
                 foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $player->addXp($event->getXpDropAmount());
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::GOLD_ORE));
                 }
                 return true;
              }
               if($block->getId() == 15){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $player->addXp($event->getXpDropAmount());
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::IRON_ORE));
                 }
                 return true;
              }
               if($block->getId() == 16){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $player->addXp($event->getXpDropAmount());
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::COAL_ORE));
                 }
                 return true;
              }
               if($block->getId() == 21){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $player->addXp($event->getXpDropAmount());
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::LAPIS_ORE));
                 }
                 return true;
              }
               if($block->getId() == 56){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $player->addXp($event->getXpDropAmount());
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::DIAMOND_ORE));
                 }
                 return true;
              }
               if($block->getId() == 153){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $player->addXp($event->getXpDropAmount());
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::QUARTZ_ORE));
                 }
                 return true;
              }
               if($block->getId() == 73){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $player->addXp($event->getXpDropAmount());
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::REDSTONE_ORE));
                 }
                 return true;
              }
               if($block->getId() == 129){
                  foreach ($event->getDrops() as $drop) {
                    $event->getPlayer()->getInventory()->addItem($drop);
                $event->setDrops([]);
                $player->addXp($event->getXpDropAmount());
                $event->setCancelled();
                $event->setXpDropAmount(0);
                $block->getLevelNonNull()->setBlock($block->asVector3(), Block::get(Block::EMERALD_ORE));
                 }
                 return true;
              }
            }
        }
    }
}