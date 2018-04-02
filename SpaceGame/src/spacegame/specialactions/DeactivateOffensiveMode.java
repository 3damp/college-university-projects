package spacegame.specialactions;

import spacegame.Game;
import spacegame.Space;
import spacegame.ships.Player;

public class DeactivateOffensiveMode implements SpecialAction {

	private Space space;
	public DeactivateOffensiveMode(Game game) {
		this.space = game.getSpace();
	}
	@Override
	public void execute() {
		Player p = (Player)space.getPlayer();
		p.setDefensiveMode();
	}

}
