package spacegame;

import java.util.ArrayList;
import java.util.Random;

import spacegame.ships.Enemy1;
import spacegame.ships.Enemy2;
import spacegame.ships.Enemy3;
import spacegame.ships.Player;
import spacegame.ships.Ship;

public class Space {
	
	private ArrayList<Ship> ships;
	private int width;
	private int height;
	private int spawnpointX = 0;
	private int spawnpointY = 0;
	
	public Space(int width, int height) {
		this.width = width;
		this.height = height;
		setShips(new ArrayList<Ship>());
	}
	
	public boolean isValidPosition(Position tempPos){
		if (tempPos.getX()==spawnpointX && tempPos.getY()==spawnpointY) {
			return false;
		}
		if (tempPos.getX()>=width || tempPos.getY()>=height) {
			return false;
		}
		if (tempPos.getX()<0 || tempPos.getY()<0) {
			return false;
		}
		
		return true;
	}

	public void createPlayer(){
		Random rnd = new Random();
		ships.add(new Player(rnd.nextInt(width),rnd.nextInt(height)));
	}
	public void createEnemy(){ //Factory
		Random rnd = new Random();
		int r = rnd.nextInt(3);
		
		switch(r){
		case 0: 
			ships.add(new Enemy1(spawnpointX,spawnpointY));
			break;
		case 1:
			ships.add(new Enemy2(spawnpointX,spawnpointY));
			break;
		case 2:
			ships.add(new Enemy3(spawnpointX,spawnpointY));
			break;
		default:
			break;
		}
	}
	
	public ArrayList<Ship> getShips() {
		return ships;
	}
	
	public Player getPlayer() {
		Player p = null;
		for(Ship ship:ships){
			if(ship.getType()==ship.PLAYER){
				p=(Player) ship;
			}
		}
		return p;
	}

	public void setShips(ArrayList<Ship> ships) {
		this.ships = ships;
	}

	public int getHeight() {
		return height;
	}

	public int getWidth() {
		return width;
	}

	public void updateShips() {
		for(int i = 0;i<ships.size();i++){
			if (ships.get(i).isAlive()) {
				ships.get(i).update(this);
			}else{
				ships.remove(ships.get(i));
				i++;
			}
		}
	}

	

	
	
}
