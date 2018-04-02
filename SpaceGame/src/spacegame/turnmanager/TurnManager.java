package spacegame.turnmanager;

import java.util.ArrayList;
import java.util.Stack;

import spacegame.ships.Ship;

public class TurnManager {
	private Stack<ArrayList<Ship>> turns;
	
	public TurnManager() {
		turns = new Stack<ArrayList<Ship>>();
		
	}
	
	public void saveTurn(ArrayList<Ship> ships){
		//Copy all ships from current turn
		ArrayList<Ship> tempShips = new ArrayList<Ship>();
		for(Ship ship:ships){
			tempShips.add(ship.copy());
		}
		turns.push(tempShips);		
	}
	
	
	public ArrayList<Ship> getLastTurn(){
		if(!turns.isEmpty())return turns.pop();
		return null;
	}
}
