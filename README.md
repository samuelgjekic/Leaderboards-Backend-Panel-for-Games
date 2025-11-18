# Laravel Backend for Leaderboards

Laravel backend for leaderboards, using a Filament panel to easily manage and monitor all leaderboard data.

This project is planned to be extended further with:

- Player authentication/login  
- Rewards  
- Achievements  
- And more…

For now, the primary feature is **leaderboard management**.

---

## Admin Panel (Filament)

Create a Filament admin user using Laravel Sail:

```bash
./vendor/bin/sail artisan make:filament-user
```

This will allow you to log into the admin panel and:

- Create new leaderboards  
- View existing leaderboards  
- Edit or delete leaderboards  
- Manage leaderboard entries  
<img width="1692" height="808" alt="image" src="https://github.com/user-attachments/assets/23c8a741-25b8-479e-9ebe-78bdddc53cb5" />
<img width="1706" height="848" alt="image" src="https://github.com/user-attachments/assets/af444f51-0252-4353-8a6a-dacda581ceb6" />



---

## API Key Generation

You will need an API key to authenticate your leaderboard API requests.

For now, the API key lives on the **User model**.

Generate one by running:

```bash
./vendor/bin/sail artisan tinker
```

Inside Tinker:

```php
$user = User::first();
$user->generateApiKey();
```

The API key returned is what you must include with your API requests.

---

## API Routes

Below are the currently available API endpoints:

### Get a leaderboard  
**GET** `/leaderboards/{id}`

### Create a leaderboard entry  
**POST** `/leaderboards/{id}/entries/create`

### Delete a leaderboard entry  
**DELETE** `/leaderboards/{id}/entries/delete/{entryId}`

More endpoints and features are planned for future updates.

---

## Roadmap

Upcoming improvements and expansions:

- Player profiles  
- Player authentication  
- Achievements system  
- Seasonal rewards  
- Global ranking and scoring logic  
- API token management screen  

Stay tuned for updates!
