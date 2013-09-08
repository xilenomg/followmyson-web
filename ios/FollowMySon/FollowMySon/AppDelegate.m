//
//  AppDelegate.m
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/6/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import "AppDelegate.h"
#import "AFHTTPClient.h"
#import "Constants.h"
#import "NSUserDefaults+RMSaveCustomObject.h"

@implementation AppDelegate

@synthesize currentUserPosition, currentUser, defaults, storyboard;

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions
{
    
    defaults = [NSUserDefaults standardUserDefaults];
    
    //get current user if exists
    currentUser = [defaults rm_customObjectForKey:@"currentUser"];
    
    //loading storyboard
    if ( IDIOM == IPAD ){
        storyboard = [UIStoryboard storyboardWithName:@"IpadStoryboard" bundle:nil];        
    }
    else{
        storyboard = [UIStoryboard storyboardWithName:@"Storyboard" bundle:nil];
    }
    
    //starting location manager
    locationManager = [[CLLocationManager alloc] init];
    locationManager.delegate = self;
    locationManager.distanceFilter = kCLDistanceFilterNone;
    locationManager.desiredAccuracy = kCLLocationAccuracyBest;
    [locationManager startUpdatingLocation];
    
    return YES;
}

- (void)applicationDidEnterBackground:(UIApplication *)application
{
    [locationManager startMonitoringSignificantLocationChanges];
}


- (void)applicationDidBecomeActive:(UIApplication *)application
{
    [locationManager stopMonitoringSignificantLocationChanges];
    [locationManager startUpdatingLocation];
}

-(void) locationManager:(CLLocationManager *)manager didUpdateToLocation:(CLLocation *)newLocation fromLocation:(CLLocation *)oldLocation
{
    BOOL isInBackground = NO;
    if ([UIApplication sharedApplication].applicationState == UIApplicationStateBackground)
    {
        isInBackground = YES;
    }
    
    currentUserPosition.latitude = newLocation.coordinate.latitude;
    currentUserPosition.longitude = newLocation.coordinate.longitude;
    
    if (isInBackground)
    {   
        [self sendBackgroundLocationToServer:newLocation];
    }
    else {
        [self sendLocationToServer: newLocation];
    }
}

-(void) sendBackgroundLocationToServer:(CLLocation *)location {
    // REMEMBER. We are running in the background if this is being executed.
    // We can't assume normal network access.
    // bgTask is defined as an instance variable of type UIBackgroundTaskIdentifier
    
    // Note that the expiration handler block simply ends the task. It is important that we always
    // end tasks that we have started.
    
    bgTask = [[UIApplication sharedApplication] beginBackgroundTaskWithExpirationHandler: ^{
                  [[UIApplication sharedApplication] endBackgroundTask:bgTask];
              }];
    
    
    // ANY CODE WE PUT HERE IS OUR BACKGROUND TASK
    

    // For example, I can do a series of SYNCHRONOUS network methods (we're in the background, there is
    // no UI to block so synchronous is the correct approach here).

    NSLog(@"BACKGROUND");
    [self sendLocationToServer: location];

    // AFTER ALL THE UPDATES, close the task

    if (bgTask != UIBackgroundTaskInvalid) {
        [[UIApplication sharedApplication] endBackgroundTask:bgTask];
        bgTask = UIBackgroundTaskInvalid;
    }
}

- (void)applicationWillEnterForeground:(UIApplication *)application
{
    // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
}

- (void)applicationWillResignActive:(UIApplication *)application
{
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
}

- (void)applicationWillTerminate:(UIApplication *)application
{
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}


- (void) sendLocationToServer: (CLLocation *) location
{
    if ( currentUser == nil ){
        return;
    }
    NSURL *url = [NSURL URLWithString: kBaseURL];
    AFHTTPClient *httpClient = [[AFHTTPClient alloc] initWithBaseURL:url];
    
    NSString *latitude = [NSString stringWithFormat:@"%f",location.coordinate.latitude];
    NSString *longitude = [NSString stringWithFormat:@"%f",location.coordinate.longitude];
    
    NSDictionary *params = [NSDictionary dictionaryWithObjectsAndKeys:
                            latitude, @"user[latitude]",
                            longitude, @"user[longitude]",
                            nil];
    
    [httpClient postPath: kSetLocationURL parameters:params success:^(AFHTTPRequestOperation *operation, id responseObject) {
        
        NSString *responseStr = [[NSString alloc] initWithData:responseObject encoding:NSUTF8StringEncoding];
        NSLog(@"Request Successful, response '%@'", responseStr);
        
    } failure:^(AFHTTPRequestOperation *operation, NSError *error) {
        
        NSLog(@"[HTTPClient Error]: %@", error.localizedDescription);
        
    }];
}

- (void) setCurrentUserToNew:(User *) newUser{
    self.currentUser = newUser;
    if ( defaults != nil ){
        [defaults rm_setCustomObject:newUser forKey:@"currentUser"];
        
        [defaults synchronize];
    }
}

@end
