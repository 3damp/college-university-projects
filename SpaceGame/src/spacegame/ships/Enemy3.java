package spacegame.ships;

import java.util.Random;

import spacegame.Position;

public class Enemy3 extends Enemy{

	public Enemy3(int x, int y) {
		super(x, y);
		name = "Enemy3";
	}

	@Override
	protected Position getNextPosition() {
		Position temp = new Position();
		Random rnd = new Random();
		
		int x=1,y=1;
		if(rnd.nextBoolean())x=-x;
		if(rnd.nextBoolean())y=-y;
		if(rnd.nextBoolean()){
			if(rnd.nextBoolean())x=0;
			else y=0;
		}
		
		temp.set(
				position.getX()+ x,
				position.getY()+ y);
		return temp;
	}

	@Override
	public int getImage() {
		if(isAlive())return 4;
		else return 0;
	}

	@Override
	protected Enemy3 getCopy() {
		return new Enemy3(0,0);
	}
}
