CREATE a function/method that takes a parameter with dice values



```
START

SET count to 1
SET result to 0
SET counter to 0

WHILE count is less than or equal to 6
    search for the values that are repeated twice

    IF the value exists THEN
        INCREMENT the result whith the value multiplied by 2
        INCREMENT counter with 1
    ENDIF

    INCREMENT count with 1
ENDWHILE

IF counter is equal to 2 THEN
    PRINT result
ELSE
    PRINT 0
ENDIF

END
```