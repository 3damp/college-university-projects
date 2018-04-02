package spacegame.battlemodes;

import spacegame.Position;

public class OffensiveMode implements BattleMode {

	@Override
	public int getStrength() {
		return 2;
	}

	@Override
	public byte getType() {
		return OFFENSIVE;
	}

	@Override
	public Position getNewPosition(Position position) {
		Position temp = new Position();
		temp.set(
				position.getX(),
				position.getY());
		return temp;
	}

}
