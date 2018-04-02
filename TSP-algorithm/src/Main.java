import java.awt.geom.Point2D;
import java.util.ArrayList;
import java.util.Scanner;

import javax.swing.JFrame;

public class Main {

	private static long time;

	public static void main(String[] args) {
		long startTime = System.currentTimeMillis();
		
		// u159 u574 rl5915 u2319 vm1748
		String file = "u159.tsp";
		
		ArrayList<Point2D> cities = TSP.loadTSPLib(file);
		ArrayList<Point2D> itinerary = TSP.loadTSPLib(file);
		
			
				
		JFrame frame = new JFrame();
		frame.setSize(1200, 900);
		frame.setDefaultCloseOperation(frame.EXIT_ON_CLOSE);
		
		System.out.println("1 = Nearest Neighbour\n2 = Nearest Neighbour modification (bad algorithm)\n3 = Refinement algorithm (SOLUTION ALGORITHM)\n");
		Scanner sc = new Scanner(System.in);
		int n = sc.nextInt(); 
		switch(n){
			case 1: // Nearest neighbour
				System.out.println("<NN>");
				itinerary = TSP.getRouteNN(itinerary);
				break;
			case 2: // Nearest neighbour modification
				System.out.println("<NN mod>");
				itinerary = TSP.getRouteNNMod(itinerary);
				break;
			case 3: // Refinement
				System.out.println("<Refi>");
				itinerary = TSP.getRouteNN(itinerary);
				itinerary = TSP.refine1(itinerary);
				break;
			default:
				System.out.println("<STOPPED>");
				System.exit(0);
		}
		
		//itinerary = TSP.getRouteNNMod(itinerary);
		//itinerary = TSP.getRouteNN(itinerary);
		//itinerary = TSP.refine1(itinerary);
		
		CanvasTSP canvas = new CanvasTSP(itinerary, cities);
		frame.add(canvas);
		
		frame.setVisible(true);
		
		
		System.out.println("END: "+(int)TSP.routeLength(itinerary));
		System.out.println("Time: "+(System.currentTimeMillis() - startTime) + " ms"); 
	}

}
