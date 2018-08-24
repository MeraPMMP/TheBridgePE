<?php

namespace AlicanCopur;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\Plugin;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Command\Command;
use pocketmine\Command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as R;
use pocketmine\math\Vector3;

class TheBridge extends PluginBase implements Listener {
	
	
	public $tag = "§6[§bTheBridge§6] §7";
	
	public function onEnable(){
		
		@mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->tag = "§6[§bTheBridge§6] §7";
		
		// ARENA CONFİGLERİ YENİLEME
		
		if(file_exists($this->getDataFolder()."Arenalar.yml")){
			$c = new Config($this->getDataFolder()."Arenalar.yml", Config::YAML);
			$cfg1 = $c->get("cfg1");
			$cfg2 = $c->get("cfg2");
			$cfg3 = $c->get("cfg3");
			$cfg4 = $c->get("cfg4");
			$cfg5 = $c->get("cfg5");
			$cfg6 = $c->get("cfg6");
			$cfg7 = $c->get("cfg7");
			$cfg8 = $c->get("cfg8");
			$cfg9 = $c->get("cfg9");
			$cfg10 = $c->get("cfg10");
			
			//Config resetleme
			
			            $cfg1->set("Durum", "Aktif");
						$cfg1->set("MaviOyuncu", 0);
						$cfg1->set("KirmiziOyuncu", 0);
						$cfg1->set("KOPuan", 0);
						$cfg1->set("MOPuan", 0);
						$cfg1->save();
						
						$cfg2->set("Durum", "Aktif");
						$cfg2->set("MaviOyuncu", 0);
						$cfg2->set("KirmiziOyuncu", 0);
						$cfg2->set("KOPuan", 0);
						$cfg2->set("MOPuan", 0);
						$cfg2->save();
						
						$cfg3->set("Durum", "Aktif");
						$cfg3->set("MaviOyuncu", 0);
						$cfg3->set("KirmiziOyuncu", 0);
						$cfg3->set("KOPuan", 0);
						$cfg3->set("MOPuan", 0);
						$cfg3->save();
						
						$cfg4->set("Durum", "Aktif");
						$cfg4->set("MaviOyuncu", 0);
						$cfg4->set("KirmiziOyuncu", 0);
						$cfg4->set("KOPuan", 0);
						$cfg4->set("MOPuan", 0);
						$cfg4->save();
						
						$cfg5->set("Durum", "Aktif");
						$cfg5->set("MaviOyuncu", 0);
						$cfg5->set("KirmiziOyuncu", 0);
						$cfg5->set("KOPuan", 0);
						$cfg5->set("MOPuan", 0);
						$cfg5->save();
						
						$cfg6->set("Durum", "Aktif");
						$cfg6->set("MaviOyuncu", 0);
						$cfg6->set("KirmiziOyuncu", 0);
						$cfg6->set("KOPuan", 0);
						$cfg6->set("MOPuan", 0);
						$cfg6->save();
						
						$cfg7->set("Durum", "Aktif");
						$cfg7->set("MaviOyuncu", 0);
						$cfg7->set("KirmiziOyuncu", 0);
						$cfg7->set("KOPuan", 0);
						$cfg7->set("MOPuan", 0);
						$cfg7->save();
						
						$cfg8->set("Durum", "Aktif");
						$cfg8->set("MaviOyuncu", 0);
						$cfg8->set("KirmiziOyuncu", 0);
						$cfg8->set("KOPuan", 0);
						$cfg8->set("MOPuan", 0);
						$cfg8->save();
						
						$cfg9->set("Durum", "Aktif");
						$cfg9->set("MaviOyuncu", 0);
						$cfg9->set("KirmiziOyuncu", 0);
						$cfg9->set("KOPuan", 0);
						$cfg9->set("MOPuan", 0);
						$cfg9->save();
						
						$cfg10->set("Durum", "Aktif");
						$cfg10->set("MaviOyuncu", 0);
						$cfg10->set("KirmiziOyuncu", 0);
						$cfg10->set("KOPuan", 0);
						$cfg10->set("MOPuan", 0);
						$cfg10->save();
			
		}else{
			$c = new Config($this->getDataFolder()."Arenalar.yml", Config::YAML);
			$c->set("cfg1", "Arena1");
			$c->set("cfg2", "Arena2");
			$c->set("cfg3", "Arena3");
			$c->set("cfg4", "Arena4");
			$c->set("cfg5", "Arena5");
			$c->set("cfg6", "Arena6");
			$c->set("cfg7", "Arena7");
			$c->set("cfg8", "Arena8");
			$c->set("cfg9", "Arena9");
			$c->set("cfg10", "Arena10");
			$c->save();
		}
		
	}
	
	public function yardim($sender){
		
		$sender->sendMessage($this->tag." §3TheBridge §2Komutları");
		$sender->sendMessage($this->tag." §5/thebridge kur [ArenaIsmi]§7= §eTheBride arenası kurarsınız.");
		$sender->sendMessage($this->tag." §5/thebridge gir [ArenaIsmi] §7= §eTheBridge arenasına girersiniz.");
		$sender->sendMessage($this->tag." §5/thebridge dil [tr/en] §7= §eTheBridge çoklu dil sistemi.");
		
	}
	
	public function mesajGonder($sender, $mesaj){
		
		$c = new Config($this->getDataFolder().$sender->getName().".yml", Config::YAML);
		$dil = $cfg->get("Dil");
		
		if($mesaj == "KendiYun"){
			
			if($dil == "en"){
				$sender->sendMessage($this->tag."§4You can't give a point on your wool!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("Tu ne peux pas gagner de point par ta propre laine");
           }elseif($dil == "de"){
                   $sender->sendMessage("Sie können keine Punkte von Ihrer eigenen Eibe erhalten");
           }elseif($dil == "ru"){
                   $sender->sendMessage("вы не можете получить очки от своего собственного тиса");
           }elseif($dil == "es"){
                   $sender->sendMessage("No puedes obtener puntos de tu propio tejo");
           } else {
				$sender->sendMessage($this->tag."§4Kendi yününden puan alamazsın!");
			}
			
		}elseif($mesaj == "KTakımPuan"){
			
			if($dil == "en"){
				$sender->sendMessage($this->tag."§4Red §6team gave 1 point!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("L'équipe rouge a gagné 1 point");
           }elseif($dil == "de"){
                   $sender->sendMessage("Rote Mannschaft hat 1 Punkt bekommen");
           }elseif($dil == "ru"){
                   $sender->sendMessage("Красная команда получила 1 очко");
           }elseif($dil == "es"){
                   $sender->sendMessage("El equipo rojo tiene 1 punto");
           } else {
				$sender->sendMessage($this->tag."§4Kırmızı §6takım 1 puan aldı!");
			}
			
		}elseif($mesaj == "KKazandı"){
			
			if($dil == "en"){
				$sender->sendMessage($this->tag."§4Red §ateam won!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("L'équipe rouge a gagné la partie");
           }elseif($dil == "de"){
                   $sender->sendMessage("Die rote Mannschaft hat das Spiel gewonnen");
           }elseif($dil == "ru"){
                   $sender->sendMessage("Красная команда выиграла игруe");
           }elseif($dil == "es"){
                   $sender->sendMessage("El equipo rojo ganó el juego");
           } else {
				$sender->sendMessage($this->tag."§4Kırmızı §atakım kazandı!");
			}
			
		}elseif($mesaj == "MTakımPuan"){
			
			if($dil == "en"){
				$sender->sendMessage($this->tag."§1Blue §6team gave 1 point!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("L'équipe bleue a gagné 1 point");
           }elseif($dil == "de"){
                   $sender->sendMessage("Blau Mannschaft hat 1 Punkt bekommen");
           }elseif($dil == "ru"){
                   $sender->sendMessage("Синяя команда 1 балл");
           }elseif($dil == "es"){
                   $sender->sendMessage("Nombre del equipo azul 1 punto");
           } else {
				$sender->sendMessage($this->tag."§1Mavi §6takım 1 puan aldı!");
			}
			
		}elseif($mesaj == "MKazandı"){
			
			if($dil == "en"){
				$sender->sendMessage($this->tag."§1Blue §ateam won!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("L'équipe bleue a gagné la partie");
           }elseif($dil == "de"){
                   $sender->sendMessage("Die blau Mannschaft hat das Spiel gewonnen");
           }elseif($dil == "ru"){
                   $sender->sendMessage("Синяя команда выиграла игру");
           }elseif($dil == "es"){
                   $sender->sendMessage("El equipo azul ganó el juego");
           } else {
				$sender->sendMessage($this->tag."§1Mavi §atakım kazandı!");
			}
			
		}elseif($mesaj == "OyunBasladi"){
			//Le jeu a commencé
			if($dil == "en"){
				$sender->sendMessage($this->tag."§e§lGame has started! Good luck!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("Le jeu a commencé");
           }elseif($dil == "de"){
                   $sender->sendMessage("Spiel gestartet");
           }elseif($dil == "ru"){
                   $sender->sendMessage("началась игра");
           }elseif($dil == "es"){
                   $sender->sendMessage("Juego comenzado");
           }  else {
				$sender->sendMessage($this->tag."§e§lOyun başladı!");
			}
			
		}elseif($mesaj == "ArenaKatıldın"){
			//Tu es rentré à l'arène
			if($dil == "en"){
				$sender->sendMessage($this->tag."Joined the arena!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("Tu es rentré à l'arène");
           }elseif($dil == "de"){
                   $sender->sendMessage("Du bist in der Arena eingeloggt");
           }elseif($dil == "ru"){
                   $sender->sendMessage("Вы вошли на арену");
           }elseif($dil == "es"){
                   $sender->sendMessage("Usted inició sesión en la arena");
           } else {
				$sender->sendMessage($this->tag."Arenaya girildi!");
			}
			
		}elseif($mesaj == "ArenaDolu"){
			
			if($dil == "en"){
				$sender->sendMessage($this->tag."§4Arena has started!");
			}elseif($dil == "fr"){
                   $sender->sendMessage("L'arène est pleine");
           }elseif($dil == "de"){
                   $sender->sendMessage("Arena voll");
           }elseif($dil == "ru"){
                   $sender->sendMessage("арена полная");
           }elseif($dil == "es"){
                   $sender->sendMessage("arena llena");
           } else {
				$sender->sendMessage($this->tag."§4Arena oynanıyor!");
			}
			
		}
		
	}
	
	public function onDeath(PlayerDeathEvent $event){
		$oyuncu = $event->getPlayer();
		$isim = $oyuncu->getName();
		
		$olen = $event->getPlayer();
$sonHasar = $olen->getLastDamageCause();
if($sonHasar instanceof EntityDamageByEntityEvent) {
  $olduren = $sonHasar->getDamager();
  if($olduren instanceof Player) {
    // Kodlar
    $name = $olduren->getLevel()->getName();
    
    $cfg = new Config($this->getDataFolder().$name.".yml", Config::YAML);
    
    if($isim == $cfg->get("MaviOyuncu")){
    	$d = $cfg->get("Dunya");
		$dunya = $this->getServer()->getLevelByName($d);
  if($dunya instanceof Level){
  	$spawn = $dunya->getSafeSpawn();
                    $olen->teleport($spawn, 0, 0);
                    $olen->teleport(new Vector3($cfg->get("MaviX"), $cfg->get("MaviY"), $cfg->get("MaviZ")));
  }
    } else {
                    $d = $cfg->get("Dunya");
		$dunya = $this->getServer()->getLevelByName($d);
  if($dunya instanceof Level){
  	$spawn = $dunya->getSafeSpawn();
                    $olen->teleport($spawn, 0, 0);
                    $olen->teleport(new Vector3($cfg->get("KirmiziX"), $cfg->get("KirmiziY"), $cfg->get("KirmiziZ")));
  }
    }

  }

}
		
	}
	
	public function onInteract(PlayerInteractEvent $event){
		
		
		$sender = $event->getPlayer();
		$dunya = $sender->getLevel()->getName();
		$blok = $event->getBlock();
		$blokid = $blok->getId();
		$damage = $blok->getDamage();
		$cfg = new Config($this->getDataFolder().$dunya.".yml", Config::YAML);
		$o1 = $cfg->get("MaviOyuncu");
		$o2 = $cfg->get("KirmiziOyuncu");
		$kpuan = $cfg->get("KOPuan");
		$mpuan = $cfg->get("KOPuan");
		$oy1 = $this->getServer()->getPlayer($o1);
		$oy2 = $this->getServer()->getPlayer($o2);
		
		if($blokid == Block::WOOL){ 
		
			if($damage == 11){
				if($sender->getName() == $cfg->get("MaviOyuncu")){
					$mesaj = "KendiYun";
					$this->mesajGonder($sender, $mesaj);
				}
				$ep = $cfg->get("KOPuan");
				$cfg->set("KOPuan", $ep + 1);
				$cfg->save();
				$mesaj = "KTakımPuan";
					$this->mesajGonder($oy1, $mesaj);
				$oy1->sendMessage(" §b$mpuan §a- §4$kpuan");
				$mesaj = "KTakımPuan";
					$this->mesajGonder($oy2, $mesaj);
							$oy2->sendMessage(" §b$mpuan §a- §4$kpuan");
				$oy1->teleport($this->getServer()->getLevelByName($cfg->get("Dunya"))->getSafeSpawn(), 0, 0);
                    $oy1->teleport(new Vector3($cfg->get("MaviX"), $cfg->get("MaviY"), $cfg->get("MaviZ")));
                    
                    $oy2->teleport($this->getServer()->getLevelByName($cfg->get("Dunya"))->getSafeSpawn(), 0, 0);
                    $oy2->teleport(new Vector3($cfg->get("KirmiziX"), $cfg->get("KirmiziY"), $cfg->get("KirmiziZ")));
                    
                    if($cfg->get("KOPuan") == 5){
                    	$mesaj = "KKazandı";
					$this->mesajGonder($oy1, $mesaj);
					$this->mesajGonder($oy2, $mesaj);
				$oy1->getInventory()->clearAll();
						$oy1->setHealth(20);
						$oy1->setFood(20);
						
						$oy2->getInventory()->clearAll();
						$oy2->setHealth(20);
						$oy2->setFood(20);
						
						$this->plugin->getServer()->broadcastMessage($this->tag.$oy1->getLevel()->getName()." Arenasında Kırmızı Takım Oyunu Kazandı!");
						
						$dunya = $cfg->get("SpawnDunya");
						$oy1->teleport($this->getServer()->getLevelByName($dunya)->getSafeSpawn(), 0, 0);
						$oy2->teleport($this->getServer()->getLevelByName($dunya)->getSafeSpawn(), 0, 0);
						
						$cfg->set("Durum", "Aktif");
						$cfg->set("MaviOyuncu", 0);
						$cfg->set("KirmiziOyuncu", 0);
						$cfg->set("KOPuan", 0);
						$cfg->set("MOPuan", 0);
						$cfg->save();
					

                    }
			}elseif($damage == 14){
				if($sender->getName() == $cfg->get("KirmiziOyuncu")){
					$mesaj = "KendiYun";
					$this->mesajGonder($sender, $mesaj);
				}
				$ep = $cfg->get("MOPuan");
				$cfg->set("MOPuan", $ep+1);
				$cfg->save();
				$mesaj = "MTakımPuan";
					$this->mesajGonder($oy1, $mesaj);
					$this->mesajGonder($oy2, $mesaj);
							$oy1->sendMessage(" §b$mpuan §a- §4$kpuan");
										$oy2->sendMessage(" §b$mpuan §a- §4$kpuan");
				$oy1->teleport($this->getServer()->getLevelByName($cfg->get("Dunya"))->getSafeSpawn(), 0, 0);
                    $oy1->teleport(new Vector3($cfg->get("MaviX"), $cfg->get("MaviY"), $cfg->get("MaviZ")));
                    
                    $oy2->teleport($this->getServer()->getLevelByName($cfg->get("Dunya"))->getSafeSpawn(), 0, 0);
                    $oy2->teleport(new Vector3($cfg->get("KirmiziX"), $cfg->get("KirmiziY"), $cfg->get("KirmiziZ")));
                    if($cfg->get("MOPuan") == 5){
                    	$mesaj = "MKazandı";
					$this->mesajGonder($oy1, $mesaj);
					$this->mesajGonder($oy2, $mesaj);
				$oy1->getInventory()->clearAll();
						$oy1->setHealth(20);
						$oy1->setFood(20);
						
						$oy2->getInventory()->clearAll();
						$oy2->setHealth(20);
						$oy2->setFood(20);
						
						$this->getServer()->broadcastMessage($this->tag.$oy1->getLevel()->getName()." Arenasında Mavi Takım Oyunu Kazandı!");
						
						$dunya = $cfg->get("SpawnDunya");
						$oy1->teleport($this->getServer()->getLevelByName($dunya)->getSafeSpawn(), 0, 0);
						$oy2->teleport($this->getServer()->getLevelByName($dunya)->getSafeSpawn(), 0, 0);
						
						$cfg->set("Durum", "Aktif");
						$cfg->set("MaviOyuncu", 0);
						$cfg->set("KirmiziOyuncu", 0);
						$cfg->set("KOPuan", 0);
						$cfg->set("MOPuan", 0);
						$cfg->save();
						
						
		
		
                    }
                    
			}
			
		}
		
		
		$durum = $cfg->get("Durum");
		if($durum == "Kurulum1"){
			$x = $blok->getX();
			$y = $blok->getY();
			$z = $blok->getZ();
			$cfg->set("MaviX", $x);
			$cfg->set("MaviY", $y);
			$cfg->set("MaviZ", $z);
			$cfg->save();
			$sender->sendMessage($this->tag." §aMavi spawn seçildi. Şimdi kırmızı takım spawnını seç..");
			$cfg->set("Durum", "Kurulum2");
			$cfg->save();
		}elseif($durum == "Kurulum2"){
			$x = $blok->getX();
			$y = $blok->getY();
			$z = $blok->getZ();
			$cfg->set("KirmiziX", $x);
			$cfg->set("KirmiziY", $y);
			$cfg->set("KirmiziZ", $z);
			$cfg->save();
			$sender->sendMessage($this->tag." §aKirmizi spawn seçildi. Şimdi bekleme lobisini seç..");
			$cfg->set("Durum", "Kurulum3");
			$cfg->save();
		}elseif($durum == "Kurulum3"){
			$x = $blok->getX();
			$y = $blok->getY();
			$z = $blok->getZ();
			$cfg->set("BLobiX", $x);
			$cfg->set("BLobiY", $y);
			$cfg->set("BLobiZ", $z);
			$cfg->set("BLobiDunya", $sender->getLevel()->getName());
			$cfg->save();
			$sender->sendMessage($this->tag." §aBekleme lobisi seçildi. Şimdi sunucu spawnını seç..");
			$cfg->set("Durum", "Kurulum4");
			$cfg->save();
		}elseif($durum == "Kurulum4"){
			$x = $blok->getX();
			$y = $blok->getY();
			$z = $blok->getZ();
			$cfg->set("SpawnX", $x);
			$cfg->set("SpawnY", $y);
			$cfg->set("SpawnZ", $z);
			$cfg->set("SpawnDunya", $sender->getLevel()->getName());
			$cfg->set("MaviOyuncu", 0);
			$cfg->set("KirmiziOyuncu", 0);
			$cfg->save();
			$sender->sendMessage($this->tag." §aKurulum tamamlandı. Oynamaya başlayın!..");
			$cfg->set("Durum", "Aktif");
			$cfg->save();
		 
		}
		
		
	}
	
	public function arenaBaslat($cfg){
	
		
		$o1 = $cfg->get("MaviOyuncu");
		$o2 = $cfg->get("KirmiziOyuncu");
		
		$oy1 = $this->getServer()->getPlayer($o1);
		$oy2 = $this->getServer()->getPlayer($o2);
		$d = $cfg->get("Dunya");
		$dunya = $this->getServer()->getLevelByName($d);
  if($dunya instanceof Level){
  	$spawn = $dunya->getSafeSpawn();
                    $oy1->teleport($spawn, 0, 0);
                    $oy2->teleport($spawn, 0, 0);
                    $oy1->teleport(new Vector3($cfg->get("MaviX"), $cfg->get("MaviY"), $cfg->get("MaviZ")));
                    $oy2->teleport(new Vector3($cfg->get("KirmiziX"), $cfg->get("KirmiziY"), $cfg->get("KirmiziZ")));
                    $mesaj = "OyunBasladi";
					$this->mesajGonder($oy1, $mesaj);
					$this->mesajGonder($oy2, $mesaj);
  }
		
                    
                        $oy1->getInventory()->clearAll();
						$oy1->setHealth(20);
						$oy1->setFood(20);
						
						$oy2->getInventory()->clearAll();
						$oy2->setHealth(20);
						$oy2->setFood(20);
						
						$oy1->getInventory()->addItem(Item::get(Item::GOLDEN_APPLE, 0, 1));
						
						$oy2->getInventory()->addItem(Item::get(Item::GOLDEN_APPLE, 0, 1));
						
						$cfg->set("MOPuan", 0);
						
						$cfg->set("KOPuan", 0);
						
						$cfg->save();
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		
		if($cmd->getName() == "thebridge"){
			
			if(!empty($args[0])){
				
        	    if($args[0] == "kur"){
        	        
                    if(file_exists($this->getDataFolder().$args[1].".yml")){
                    	
                        $sender->sendMessage($this->tag." §4Bu arena zaten var.");
                    
                    } else {
                    	
                        if($sender->hasPermission("thebridge.kur")){
                        	
                            $cfg = new Config($this->getDataFolder().$args[1].".yml", Config::YAML);
                            $cfg->set("Dunya", $sender->getLevel()->getName());
                            $cfg->set("Durum", "Kurulum1");
                            $cfg->save();
                            $sender->sendMessage($this->tag." §aArena kuruluyor. Şimdi mavi takım spawn noktasını seç.");
                        
                        } else {
                        	
                            $sender->sendMessage($this->tag." §4Arena kurma yetkin yok.");
                        
                        }
                    
                    }
                  
                }elseif($args[0] == "dil"){
                	$c = new Config($this->getDataFolder().$sender->getName().".yml", Config::YAML);
                    if($args[1] == "tr"){
                    	$c->set("Dil", "tr");
                    $sender->sendMessage($this->tag."§aTürkçe seçildi!");
                    $c->save();
                    }elseif($args[1] == "en"){
                    	$c->set("Dil", "en");
                    $sender->sendMessage($this->tag."§aSelected English!");
                    $c->save();
                    }elseif($args[1] == "fr"){
                    	$c->set("Dil", "fr");
                    $sender->sendMessage($this->tag."§aSelected Français!");
                    $c->save();
                    }elseif($args[1] == "de"){
                    	$c->set("Dil", "de");
                    $sender->sendMessage($this->tag."§aSelected Deutsch!");
                    $c->save();
                    }elseif($args[1] == "ru"){
                    	$c->set("Dil", "ru");
                    $sender->sendMessage($this->tag."§aSelected Russian!");
                    $c->save();
                    }elseif($args[1] == "es"){
                    	$c->set("Dil", "es");
                    $sender->sendMessage($this->tag."§aSelected Espanol!");
                    $c->save();
                    }else{
                    	$sender->sendMessage($this->tag."§3[tr/en/fr/de/ru/es]!");
                    }
                }elseif($args[0] == "gir"){
                	
                    if(file_exists($this->getDataFolder().$args[1].".yml")){
                	$cfg = new Config($this->getDataFolder().$args[1].".yml", Config::YAML);
    $durum = $cfg->get("Durum");
    $o1 = $cfg->get("MaviOyuncu");
                    $o2 = $cfg->get("KirmiziOyuncu");
                    	if($durum == "Aktif"){
    $cfg->set("MaviOyuncu", $sender->getName());
    $cfg->set("Durum", "Aktif2");
  $cfg->save();
  $dunya = $cfg->get("BLobiDunya");
        $this->getServer()->loadLevel($dunya);
        $level = $sender->getServer()->getLevelByName($dunya);
  $x = $cfg->get("MaviX");
  $y = $cfg->get("MaviY");
  $z = $cfg->get("MaviZ");
        $sender->teleport(new Position($x, $y, $z, $level));

  
                    $mesaj = "ArenaKatıldın";
					$this->mesajGonder($sender, $mesaj);
  
                    
                    	    } elseif($durum == "Aktif2"){
    $cfg->set("KirmiziOyuncu", $sender->getName());
    $cfg->set("Durum", "Dolu");
  $cfg->save();
                               
                                $cfg->set("Durum", "Dolu");
                            $cfg->save();
                            $mesaj = "ArenaKatıldın";
					$this->mesajGonder($sender, $mesaj);
					$this->arenaBaslat($cfg);
                            
                    
                    	    } else {
                    	$mesaj = "ArenaDolu";
					$this->mesajGonder($sender, $mesaj);
                    }
                    }
                   
               } else {
            	$this->yardim($sender);
            }
			
		}
		return true;
	}
	}
	}
