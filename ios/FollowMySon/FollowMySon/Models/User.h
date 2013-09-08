//
//  User.h
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/7/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "NSObject+RMArchivable.h"

@interface User : NSObject

@property(nonatomic, retain) NSString *user_name;
@property(nonatomic, retain) NSString *user_phone;
@property(nonatomic) NSString *user_id;

@end
