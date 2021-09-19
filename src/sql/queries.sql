/** Query №1 Selection of debtors */

SELECT
    clients.client_code,
    accounting.paid
FROM
    clients
    INNER JOIN accounting ON clients.client_code = accounting.client_code
WHERE
    accounting.paid = 0

/** Query №2 Selection of clients who bought a membership in August */

SELECT
    clients.client_code,
    clients.last_name,
    clients.first_name
FROM
    clients
WHERE
    clients.client_code IN (
        SELECT
            accounting.client_code
        FROM
            accounting
        WHERE
            accounting.month = "August"
    )

/** Query №3 Selection the number of memberships */

SELECT
    COUNT(membership_code) AS "Number of members"
FROM
    membership

 /** Query №4 Selection the number of clients, who train with a certain trainer */

SELECT
    trainers.trainer_code,
    trainers.trainer_full_name,
    COUNT(clients.client_code) AS "Number of clients"
FROM
    trainers
    INNER JOIN clients ON trainers.trainer_code = clients.trainer_code
GROUP BY
    trainers.trainer_code,
    trainers.trainer_full_name

/** Query №5 Selection the trainers, who have more than 1 client. Award calculation */

SELECT
    trainers.trainer_code,
    trainers.trainer_full_name,
    COUNT(clients.client_code) AS "Number of clients",
    (trainers.salary) * 0.2 AS "Award"
FROM
    trainers
    INNER JOIN clients ON trainers.trainer_code = clients.trainer_code
GROUP BY
    trainers.trainer_code,
    trainers.trainer_full_name,
    trainers.salary
HAVING
    COUNT(clients.client_code) > 1

/** Query №6 Selection of membership codes with twice-weekly intervals and a 400+ price */

SELECT
    membership_code,
    price
FROM
    membership
WHERE
    description = "2 times per week"
    OR description = "3 times per week"
    AND price > 400
ORDER BY
    price DESC

/** Query №7 Selection of max, min and avg salary among trainers */

SELECT
    MAX(salary) AS "Max salary",
    MIN(salary) AS "Min salary",
    AVG(salary) AS "Avg salary"
FROM
    trainers

/** Query №8 Creating view, that shows membership price, type of exercise and weekly intervals */

    CREATE VIEW PriceView AS
SELECT
    membership.description,
    membership.price,
    gyms.name
FROM
    membership
    INNER JOIN gyms ON membership.gym_code = gyms.gym_code

--Show result: SELECT * FROM `priceview`