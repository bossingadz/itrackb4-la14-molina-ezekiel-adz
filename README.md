<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Learning Activity 10 — Monster Hunter Lookup Table

1: Which column did you turn into a table, and why that one and not another?
I converted platform into a platforms lookup table because platform categories repeat across records and can be extended with attributes. title, price, and stock are unique or numeric, making platform the only column that represents a reusable entity.

2: What number did screenshot 6 show, and why exactly that number?
It showed 8 queries (2 setup queries + 6 lazy-loading queries). Two queries fetched the main game records and filter data, and as the Blade view iterated through each row, Eloquent executed 6 additional queries (one per row) to lazy-load each platform relationship.

3: Your belongsTo method is named in the singular. What would break if you made it plural?
Eloquent would look for a foreign key named platforms_id on the table instead of platform_id. Since that column does not exist in the database, Laravel would throw a QueryException.

# Learning Activity 11 — Monster Hunter CRUD

1: Route model binding needs two things to be true. Name both, and say what happens when only one of them is.
Route model binding requires the controller parameter to be type-hinted with the model class (Game), and its variable name ($monsterhunter) must match the route resource segment name ({monsterhunter}) exactly. If only the type-hint is correct but the variable name is wrong, Laravel will fail to inject the model instance silently, resulting in $monsterhunter being null or uninitialized without throwing an explicit error.

2: Your Delete link opened the detail page instead of deleting anything. Explain why.
HTML <a> links can only issue HTTP GET requests. In Laravel resource routing, GET /monsterhunters/{monsterhunter} maps directly to the show() method, whereas destroy() requires an HTTP DELETE request sent via a form with @method('DELETE').

3: old() takes a second argument on your edit form. What would break if you left it out, and what would break if you used only it?
If the second fallback argument is left out, the form fields will render completely blank when first loaded because no session flash data exists yet. If only the second argument was used without old(), failed validation re-submissions would overwrite user-entered inputs back to the database defaults instead of retaining the submitted values.

# Learning Activity 12 — Make the Failures Yours

1: The top of your error page named a file inside vendor. Say why that was not where your mistake was, and where the page showed you it actually was.
The top of the error page referenced a file under vendor/laravel/framewor because that is where Laravel's internal query builder dispatched the missing method call. The actual mistake originated inside app/Http/Controllers/MonsterHunterController.php on the line calling Game::withh('platform')`, which was clearly identified down in the expanded application stack trace frame.

2: You wrote one Log::info line with a context array. Name something it will tell you next month that the error page could not.
The Log::info context array records the specific database primary key (id) of the modified Game record at the exact moment of creation or update. An error stack trace only captures unhandled runtime crashes, whereas context logging provides a historical audit trail showing which specific records were successfully modified and when.

3: Your guard answers with 403 instead of redirecting back with a message. Say when each of the two is the better answer.
A 403 Forbidden status is appropriate for strict authorization or data integrity rule violations (such as attempting to delete the final Game in a Platform category) where the request is fundamentally unauthorized. Redirecting back with a session alert is better for recoverable user input mistakes or soft validation failures during normal web navigation.

# Learning Activity 13 — Open the Front Door

1: Your HomeController is not a resource controller. Name two things an index() on a resource controller does that yours does not have to.
Unlike MonsterHunterController@index, HomeController@index does not have to accept a Request parameter to parse search/filter query strings, nor does it need to build dynamic Eloquent query chains with pagination (paginate()->withQueryString()). It simply executes static Game::count() and Platform::count() queries and passes those integers to the landing view.

2: Your pagination links lost the search term until you added one method. Say what those links contained before, and what the controller therefore received.
Before adding withQueryString(), the generated pagination links contained only the ?page=2 parameter (e.g., /monsterhunters?page=2) and stripped out search=Monster. Consequently, when clicking page 2, $request->query('search') evaluated to null in MonsterHunterController@index, causing the controller to return the unfiltered dataset.

3: A misspelled sort value does not break your page. Explain why that is worse than an error, and what your allowed list does about it.
A silent failure is worse than an explicit error because SQLite treats an unrecognized column string as a constant literal in ORDER BY, returning unsorted records without alerting developers or users that the feature is broken. Checking $sort against in_array($sort, ['title', 'price', 'stock']) intercepts invalid or malicious URL parameters and forces a safe fallback to title.


# Laboratory Activity 14 — Locking the Front Door

1: Authentication and authorisation are not the same. In one sentence each: what did this lesson give you, and what is still missing next meeting?
This lesson gave our Monster Hunter application authentication, verifying who a visitor is through registration, login, and session tracking. What is still missing is authorisation—determining what specific actions a signed-in user is permitted to perform (such as restricting record deletion or edits to administrators or record owners).

2: Why does a successful login call session()->regenerate()? What goes wrong if you skip it?
Calling `session()->regenerate()` issues a brand-new session identifier upon login while keeping session data intact. If skipped, the app remains vulnerable to session fixation attacks, where an attacker who pre-set a user's session ID before login could hijack their authenticated session afterward.

3: Why does a failed login use the same message for a wrong password and an unknown email?
Returning the generic message `"The provided credentials do not match our records."` prevents user enumeration. If the form revealed whether an email exists in the `users` table, attackers could harvest valid registered email addresses for targeted brute-force or phishing attacks.

4: Why do index and show stay public while create/edit/update/destroy use auth?
In our Monster Hunter catalog, browsing the game list (`index`) and viewing game details (`show`) are read-only operations meant for any visitor, whereas `create`, `store`, `edit`, `update`, and `destroy` mutate database records and must be restricted to authenticated users.

5: You hid Add (and actions) for guests. Why is that not enough to secure those actions? What actually stops a stranger?
Hiding UI buttons with `@auth` only removes visual links from the HTML, leaving the underlying `/monsterhunters/create` or `/monsterhunters/{id}/edit` URLs accessible if typed directly or submitted via HTTP requests. The `auth` middleware attached to those five resource routes is what actually intercepts unauthorized requests at the server level and redirects strangers to login.

6: In screenshot 20 the route name was wrong. Why does auth middleware care that the route is named exactly login?
By default, Laravel's `Authenticate` middleware redirects unauthenticated users by calling `route('login')`. When the GET login route was renamed to `signin`, the middleware could no longer resolve the named route `login`, throwing a `RouteNotFoundException`.