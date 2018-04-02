package spacegame.ships;

public abstract class Enemy extends Ship{

	public Enemy(int x, int y) {
		super(x, y);
		type = ENEMY;
	}

}
