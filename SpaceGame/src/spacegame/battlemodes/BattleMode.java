package spacegame.battlemodes;

import spacegame.Position;

public interface BattleMode {	
	public static final byte DEFENSIVE = 0;
	public static final byte OFFENSIVE = 1;
	public int getStrength();
	public byte getType();
	public Position getNewPosition(Position position);
}
