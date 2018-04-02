package spacegame.ships;

import java.util.Random;

import spacegame.Position;

public class Enemy2 extends Enemy{

	public Enemy2(int x, int y) {
		super(x, y);
		name = "Enemy2";
	}

	@Override
	protected Position getNextPosition() {
		Position temp = new Position();
		Random rnd = new Random();
		
		int x=1,y=1;
		if(rnd.nextBoolean())x=-x;
		if(rnd.nextBoolean())y=-y;
		
		temp.set(
				position.getX()+ x,
				position.getY()+ y);
		return temp;
	}

	@Override
	public int getImage() {
		if(isAlive())return 3;
		else return 0;
	}

	@Override
	protected Enemy2 getCopy() {
		return new Enemy2(0,0);
	}

}
