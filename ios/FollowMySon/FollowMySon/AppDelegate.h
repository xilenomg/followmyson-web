//
//  AppDelegate.h
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/6/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import "User.h"

@interface AppDelegate : UIResponder <UIApplicationDelegate, CLLocationManagerDelegate>{
    
    //Main Storyboard
    UIStoryboard *storyboard;
    
    //Background task
    UIBackgroundTaskIdentifier bgTask;
    
    //Location manager
    CLLocationManager *locationManager;
    
    //keeps userLocation
    CLLocationCoordinate2D currentUserPosition;
    
    //Logged in user
    User *currentUser;
    
    NSUserDefaults *defaults;
}

@property (strong, nonatomic) UIWindow *window;
@property (nonatomic, readwrite) CLLocationCoordinate2D currentUserPosition;
@property (nonatomic, strong) User *currentUser;
@property (nonatomic, strong) NSUserDefaults *defaults;
@property (nonatomic, strong) UIStoryboard *storyboard;

- (void) sendLocationToServer: (CLLocation *) location;
- (void) setCurrentUserToNew:(User *) newUser;

@end
