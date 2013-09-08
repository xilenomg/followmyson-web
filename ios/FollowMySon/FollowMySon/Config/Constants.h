//
//  Constants.h
//  FollowMySon
//
//  Created by Luis Felipe Perez on 9/7/13.
//  Copyright (c) 2013 Dataminas Tecnologia e Sistemas. All rights reserved.
//

#ifndef FollowMySon_Constants_h
#define FollowMySon_Constants_h

#ifdef DEBUG
    #define kBaseURL @"http://192.168.1.11"
#else
    #define kBaseURL @"http://followmyson.dataminas.com.br"
#endif

#define kSetLocationURL @"/api/postLocation.php"
#define kCreateUserURL @"/api/createUser.php"

#define IDIOM    UI_USER_INTERFACE_IDIOM()
#define IPAD     UIUserInterfaceIdiomPad


#endif
