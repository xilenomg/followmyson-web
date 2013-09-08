//
//  SendLocationViewController.m
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/6/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import "SendLocationViewController.h"
#import "AppDelegate.h"

#define METERS_PER_MILE 1609.344

@interface SendLocationViewController (){
    AppDelegate *delegate;
}
@end

@implementation SendLocationViewController


- (void)viewDidLoad
{
    [super viewDidLoad];
    
    delegate = (AppDelegate *)[[UIApplication sharedApplication] delegate];
    
    //centralizing map on user location
    [self performSelector:@selector(centralizeUserPosition) withObject:nil afterDelay:1.0];
    self.navigationController.navigationBar.hidden = NO;
    [self.navigationItem setHidesBackButton:YES];

}

-(void)centralizeUserPosition{
//
    MKCoordinateRegion viewRegion = MKCoordinateRegionMakeWithDistance(delegate.currentUserPosition, 0.5*METERS_PER_MILE, 0.5*METERS_PER_MILE);
//
    [_mapView setRegion:viewRegion animated:YES];
}


#pragma buttons
-(IBAction)centralizeButton:(id)sender{
    [self performSelector:@selector(centralizeUserPosition) withObject:nil afterDelay:0.1];
}

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
    }
    return self;
}


- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}
@end
