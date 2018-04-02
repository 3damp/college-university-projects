package spacegame;

import java.util.ArrayList;

import spacegame.ships.Player;
import spacegame.ships.Ship;

public class BattleSolver {

	public BattleSolver() {
	}
	public void resolveConflicts(ArrayList<Ship> ships){
		for(Ship ship: ships){
			ArrayList<Position> cellsChecked = new ArrayList<Position>();
			
			//Find player
			if (ship.getType()==ship.PLAYER && !cellsChecked.contains(ship.getPosition())) {
				cellsChecked.add(ship.getPosition());
				
				ArrayList<Player> playersInCell = new ArrayList<Player>();
				ArrayList<Ship> enemiesInCell = new ArrayList<Ship>();
				
				//Find all ships in same cell
				for(Ship ship2: ships){
					if (ship.getPosition().equals(ship2.getPosition())) {
						if (ship2.getType()==ship2.ENEMY) {
							enemiesInCell.add(ship2);
						}else if(ship2.getType()==ship2.PLAYER){
							playersInCell.add((Player) ship2);
						}
					}
				}
				resolveConflict(playersInCell,enemiesInCell);
			}
		}
	}
	
	private void resolveConflict(ArrayList<Player> playersInCell, ArrayList<Ship> enemiesInCell) {
		if (enemiesInCell.isEmpty()) {
		}else{
			int playersStrength = 0;
			int enemies = enemiesInCell.size();
			for(Player player:playersInCell){
				playersStrength += player.getStrength();
			}
			if (playersStrength>=enemies) {
				for(Ship enemy:enemiesInCell){
					enemy.destroy();
					System.out.println("Battle won");
				}
			}else{
				for(Ship player:playersInCell){
					player.destroy();
					System.out.println("Battle lost");
				}
			}
		}
	}
	
	
	
}
