//
//  SignupViewController.h
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/7/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface SignupViewController : UIViewController <UITextFieldDelegate>{
    IBOutlet UITextField *nameTF;
    IBOutlet UITextField *phoneTF;
    IBOutlet UITextField *passwordTF;
    IBOutlet UIButton *signupButton;
}

@property (nonatomic, retain) IBOutlet UITextField *nameTF;
@property (nonatomic, retain) IBOutlet UITextField *phoneTF;
@property (nonatomic, retain) IBOutlet UITextField *passwordTF;
@property (nonatomic, retain) IBOutlet UIButton *signupButton;

-(void)dismissKeyboard;

-(IBAction)signupButtonAction:(id)sender;

@end
