import java.awt.Canvas;
import java.awt.Color;
import java.awt.Graphics;
import java.awt.geom.Point2D;
import java.util.ArrayList;

public class CanvasTSP extends Canvas {
	
	private ArrayList<Point2D> coords;
	private double scale = 1;
	private ArrayList<Point2D> cities;
	
	public CanvasTSP(ArrayList<Point2D> coords, ArrayList<Point2D> cities) {
		this.coords = coords;
		this.scale = calculateScale(coords);
		this.cities = cities;
	}
	public CanvasTSP(ArrayList<Point2D> coords, ArrayList<Point2D> cities, int scale) {
		this.coords = coords;
		this.scale = scale;
		this.cities = cities;
	}
	
	
	@Override
	public void paint(Graphics g) {
		g.setColor(new Color(0f,0f,0f));
		g.fillRect(0, 0, getWidth(), getHeight());
		
		paintDots(g,cities);
		
		paintLines(g,coords);
		
		
	}
	private void paintLines(Graphics g, ArrayList<Point2D> coords2) {
		Color color = new Color(255,255,0);
		g.setColor(color);
		Point2D prev = coords2.get(0);

		for(Point2D c:coords2){
			int x = (int) ((c.getX()/scale)*getHeight());
			int y = (int) ((c.getY()/scale)*getHeight());
			int xp = (int) ((prev.getX()/scale)*getHeight());
			int yp = (int) ((prev.getY()/scale)*getHeight());
			
			g.drawLine(xp, yp, x, y);
			prev = c;
			
			if(color.getGreen()>=10){
				color = new Color(255,(color.getGreen()-2),0);
				g.setColor(color);
			}else if(color.getBlue()<250){
				color = new Color(255,0,color.getBlue()+2);
				g.setColor(color);
			}else if(color.getRed()>=10){
				color = new Color(color.getRed()-2, 0,255);
				g.setColor(color);
			}
		}
		Point2D p1 = coords2.get(0);
		Point2D p2 = coords2.get(coords2.size()-1);
		int x = (int) ((p1.getX()/scale)*getHeight());
		int y = (int) ((p1.getY()/scale)*getHeight());
		int xp = (int) ((p2.getX()/scale)*getHeight());
		int yp = (int) ((p2.getY()/scale)*getHeight());
		g.drawLine(xp, yp, x, y);
		
	}
	private void paintDots(Graphics g, ArrayList<Point2D> coords){
		g.setColor(Color.white);
		Point2D prev = coords.get(0);
		for(Point2D c:coords){
			int x = (int) ((c.getX()/scale)*getHeight());
			int y = (int) ((c.getY()/scale)*getHeight());
			int xp = (int) ((prev.getX()/scale)*getHeight());
			int yp = (int) ((prev.getY()/scale)*getHeight());
			g.fillOval(x, y, 4, 4);
		}
		
	}
	
	public static double calculateScale(ArrayList<Point2D> cities) {
		double max = 0;
		for (Point2D city : cities) {
			if(city.getX()>max) max = city.getX();
			if(city.getY()>max) max = city.getY();
		}
		return max*1.1;
	}
	
}