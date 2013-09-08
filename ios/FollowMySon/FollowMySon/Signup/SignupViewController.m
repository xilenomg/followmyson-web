//
//  SignupViewController.m
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/7/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import "SignupViewController.h"
#import "AFHTTPClient.h"
#import "Constants.h"
#import "NSString+Hashes.h"
#import "User.h"
#import "AppDelegate.h"

#import "SendLocationViewController.h"

@interface SignupViewController (){
    AppDelegate *delegate;
}
@end

@implementation SignupViewController

@synthesize nameTF, phoneTF, signupButton, passwordTF;

-(BOOL) textFieldShouldReturn:(UITextField *)textField{
    [textField resignFirstResponder];
    return YES;
}

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    delegate = (AppDelegate *)[[UIApplication sharedApplication] delegate];
    
    UITapGestureRecognizer *tap = [[UITapGestureRecognizer alloc]
                                   initWithTarget:self
                                   action:@selector(dismissKeyboard)];
    
    [self.view addGestureRecognizer:tap];
    
    self.navigationController.navigationBar.hidden = YES;
    
    //user is already logged in
    if ( delegate.currentUser != nil ) {
        [self moveUserToMainScreen];
    }
}

- (void) moveUserToMainScreen{
    SendLocationViewController *sendLocationViewController = [delegate.storyboard instantiateViewControllerWithIdentifier:@"SendLocationViewController"];
    [self.navigationController pushViewController:sendLocationViewController animated:YES];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}






-(void)dismissKeyboard {
    [nameTF resignFirstResponder];
    [phoneTF resignFirstResponder];
    [passwordTF resignFirstResponder];
}

-(IBAction)signupButtonAction:(id)sender{
    if ([self doFormValidation]){
        [self createUser];
    }
}

-(BOOL) doFormValidation{
    NSMutableArray *messages = [[NSMutableArray alloc] init];
    if ( [[nameTF text] isEqualToString:@""] ){
        [messages addObject:@"Name can NOT be empty"];
    }
    
    if ( [[phoneTF text] isEqualToString:@""] ){
        [messages addObject:@"Phone can NOT be empty"];
    }
    
    if ( [[passwordTF text] isEqualToString:@""] ){
        [messages addObject:@"Password can NOT be empty"];
    }
    
    if ( [messages count] > 0 ){
        NSString *message = [messages componentsJoinedByString:@"\n"];
        
        UIAlertView *alertView = [[UIAlertView alloc] initWithTitle:@"Form Validation" message:message delegate:nil cancelButtonTitle:@"I will fix it" otherButtonTitles:nil, nil];
        
        [alertView show];
        
        return NO;
    }
    
    return YES;
}

-(void) createUser{
    NSURL *url = [NSURL URLWithString: kBaseURL];
    AFHTTPClient *httpClient = [[AFHTTPClient alloc] initWithBaseURL:url];
    
    NSString *name = [nameTF text];
    NSString *phone = [phoneTF text];
    NSString *password = [[passwordTF text] sha1];
    
    NSDictionary *params = [NSDictionary dictionaryWithObjectsAndKeys:
                            name, @"user[name]",
                            phone, @"user[phone]",
                            password, @"user[password]",
                            nil];
    
    [httpClient postPath: kCreateUserURL parameters:params success:^(AFHTTPRequestOperation *operation, id responseObject) {
        
        //parse out the json data
        NSError* error;
        NSDictionary *json = [NSJSONSerialization
                              JSONObjectWithData:responseObject //1
                              
                              options:kNilOptions 
                              error:&error];
        
        User *user = [[User alloc] init];
         
        user.user_id = [json objectForKey:@"user_id"];
        user.user_name = [json objectForKey:@"user_name"];
        user.user_phone = [json objectForKey:@"user_phone"];
        
        [delegate setCurrentUserToNew:user];
        
        [self moveUserToMainScreen];
        
    } failure:^(AFHTTPRequestOperation *operation, NSError *error) {
        
        NSLog(@"[HTTPClient Error]: %@", error.localizedDescription);
        
    }];
}

@end
