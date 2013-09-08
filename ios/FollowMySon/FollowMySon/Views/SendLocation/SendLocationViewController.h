//
//  SendLocationViewController.h
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/6/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import <MapKit/MapKit.h>

@interface SendLocationViewController : UIViewController  

@property (weak, nonatomic) IBOutlet MKMapView *mapView;

-(void)centralizeUserPosition;

-(IBAction)centralizeButton:(id)sender;

@end
