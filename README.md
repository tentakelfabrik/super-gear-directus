# Gear - Directus PHP Client

Small Libary to request Directus API.

## ItemCollection

**URL**
**Token**

```PHP
$itemCollection = new ItemCollection($url, $token);
$articles = $itemCollection->find('articles', ['status' => 'published']);
```
