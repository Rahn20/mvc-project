CREATE a function/method that takes a parameter with dice values



```
START

SET count to 1
SET result to 0

WHILE count is less than or equal to 6
    search for the values that are repeated 3 times

    IF the value exists THEN
        SET result to the value multiplied by 3
    ENDIF

    INCREMENT count with 1

ENDWHILE

PRINT the result

END
```