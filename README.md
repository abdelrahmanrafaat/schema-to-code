# schema-to-code

Laravel Packages for Converting Relational Database schema with a predefined syntax To code (Models & Migrations)

---
### Package Use-cases
- If you want a fast way to scaffold your models and migrations without writing bunch of commands and going through multiple files to define relations in the models and migrations
- For example creating MVP or small project and you already have a DB schema in your mind 

---
### 1- Package Installation
```
  $ composer require abdelrahmanrafaat/schema-to-code:dev-master
```
---
### 2- Package Usage

- Create schema file and put it anywhere accessible from the project root directory
- Schema file should be **.txt** extension
- Creating schema.txt in the app directory

```
  $ touch app/schema.txt
```

---
### 3- Write your schema
- Schema should have even number of non-empty lines



#### Models Syntax
- line for Models -**Two** models per line seperated by double colon **:** - like one of the following:
- ``` user:profile ``` 
``` actor:movie ```
``` cart:product ```


#### Relations Syntax
- line for defining the relation between the two models like one of the following:
- ``` 1:1 ```
``` 1:m ```
``` m:1 ```
``` m:m ```

***
##### One to One Relation

- Defining a relation between user and profile as one to one relation
- (**User has one profile** and **Profile belongs to a User**) it will be written like this :
 ```
   user : profile
     1  :   1 
 ```

***
##### One to Many Relation

- Defining a relation between user and order as one to many relation
- (**User has many Orders** and **Order belongs to a User**) it will be written like this :
 ```
   user : order
     1  :   m 
 ```
 Or like this :
 ```
   order : user
     m   :  1 
 ```

***
##### Many to Many Relation

- Defining a relation between product and cart as many to many relation
- (**Cart has many Product** and **Product can be in multiple Carts**) it will be written like this :
 ```
   cart : product
     m  :   m 
 ```
 Or like this :
 ```
   cart : product
     m  :   m 
 ```

***

##### An Example for a complete schema 
```
User:Profile
1:1

User:Actor
1:1

Actor:Movie
M:m

Movie:Review
1:M

Review:User
M:1
```

---
### 4- Convert Schema to code :
- You can replace app/schema.txt with the path to the schema file that you have created earlier 
```
  $ php artisan conver:schema-to-code app/schema.txt
```

---
### 5- After the command finishes it will generate a report for the created migrations and models

| Created Migrations ...     |
| -------------------------- |
| create_users_table         |
| create_profiles_table      |
| create_actors_table        |
| create_movies_table        |
| create_reviews_table       |
| update_profiles_relations  |
| update_actors_relations    |
| create_actors_movies_table |
| update_reviews_relations   |

| Created Models ... |
| ------------------ |
| User               |
| Profile            |
| Actor              |
| Movie              |
| Review             |

---
### 6- Migrate
- Every thing is set now, just run the migrate command to create the tables and relations in your DB
```
  $ php artisan migrate
```

---
### 7- Explore
- Now open the created models in the /app directory to see the methods defined for the relations of each model and to know how to call them in your code
- Open the /database/migrations directory to see the defentations for the relations, and to start adding some fields for every table
---

#### Final Notes :
- **Be careful : If you have an existing models they will be overridden if they were in the schema file** 
- Models are created in /app directory
- Migrations are created in /database/migrations directory
- All the created migrations follows laravel naming conventions and the relations in the models and migrations also follows laravel naming conventions
---
Happy Coding ^_^

