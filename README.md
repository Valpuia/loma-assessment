## USER

Below is the API endpoint for user

- LIST (GET) - localhost/api/users
- CREATE (POST) - localhost/api/user/create :: (required fields: name, username, email, password)
- UPDATE (POST) - localhost/api/user/update/{id} :: (required fields: name, username, email, password)
- DELETE (DELETE) - localhost/api/user/delete/{id}

## AUTHENTICATION

Below is the API endpoint for authentication

- LOGIN (POST) - localhost/api/login :: (required fields: email, password)
- LOGOUT (POST) - localhost/api/logout :: :: (required fields: email, password)

## MEMBERSHIP

Below is the API endpoint for membership

- LIST (GET) - localhost/api/memberships
- CREATE (POST) - localhost/api/membership/create :: (required fields: plan, amount)
- UPDATE (POST) - localhost/api/membership/update/{id} :: (required fields: plan, amount)
- DELETE (DELETE) - localhost/api/membership/delete/{id}

## SUBSCRIPTION

Below is the API endpoint for subcription

- SUBSCRIBE (POST) - localhost/api/subscribe :: (required fields: user_id, membership_id)
- UNSUBSCRIBE (POST) - localhost/api/un-subscribe/{id}

## AUTO RENEW SUBSCRIPTION

`php artisan subscription:renew`
