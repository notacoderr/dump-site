<?php
$min = (int) ($config->get('min') * 1200); #1200 = 1 min
$this->getScheduler()->scheduleRepeatingTask(new CheckSubscriptionsTask($this), $min);

namespace Johnmacrocraft\Newspaper\tasks;
use Johnmacrocraft\Newspaper\Newspaper;
use pocketmine\scheduler\Task;

class CheckSubscriptionsTask extends Task {
	/** @var Newspaper */
	private $plugin;
	public function __construct(Newspaper $plugin) {
		$this->plugin = $plugin;
	}
	public function onRun(int $currentTick) {
		$this->plugin->checkSubscriptions();
	}
}

public function setText(string $name) {
  foreach ($this->plugin->texts->getAll() as $level => $array) {
   foreach ($array as $loc => $type) {
    $pos = explode("_", $loc);
      if(isset($pos[1])) {
        $v3 = new Vector3((float) $pos[0],(float) $pos[1],(float) $pos[2]);
          $this->plugin->addText($v3, $type, [$this->plugin->getServer()->getPlayerExact($name)]);
      }
    }
  }
}

use pocketmine\event\entity\EntityDamageByEntityEvent;

public function addText(Vector3 $location, string $type = "title", $player = null) {
		switch ($this->getServer()->getName()) {
			case 'PocketMine-MP':
				$typetitle = $this->config->get("texts-title")[$type];
				$id = implode("_", [$location->getX(), $location->getY(), $location->getZ()]);
				$particle = new FloatingTextParticle($location, color::GOLD . "<<<<<>>>>>", $this->colorize($typetitle) . "\n" . $this->getData($type));
				$this->getServer()->getLevelByName($this->config->get("texts-world"))->addParticle($particle, $player);
				$this->particles[$id] = $particle;
				break;
			case 'Altay':
				$typetitle = $this->config->get("texts-title")[$type];
				$id = implode("_", [$location->getX(), $location->getY(), $location->getZ()]);
				$particle = new FloatingTextParticle(color::GOLD . "<<<<<>>>>>", $this->colorize($typetitle) . "\n" . $this->getData($type), $location);
				$this->getServer()->getLevelByName($this->config->get("texts-world"))->addParticle($location, $particle);
				$this->particles[$id] = $particle;
				break;
		}
}

                $arr = [];
                foreach($this->plugin->db['ban-item'] as $item => $value){
                    array_push($arr, array('text' => '- ' . $item));
                }
                $packet = new ModalFormRequestPacket();
                $packet->formId = 11119;
                $packet->formData = json_encode([
                        'type' => 'form',
                        'title' => 'CraftBan List',
                        'content' => 'This is List!!',
                        'buttons' => $arr
                ]);
                $sender->sendDataPacket($packet);
                break;
