UPDATE public.oauth_clients
SET name = 'Laravel Password Grant Client',
    secret = 'Ev8NQcCCW7uAIaJtT011R5NCnM7GG5i06henYHg2',
    provider = 'users'
WHERE public.oauth_clients.id = 2;
