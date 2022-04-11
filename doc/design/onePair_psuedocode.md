CREATE a function/method that takes a parameter with dice values


```
START
SET count to 6
SET result to 0

WHILE count is bigger than or equal to 1
    search for the value that is repeated twice

    IF the value exists THEN
        SET result to the value multiplied by 2
        BREAK
    ENDIF

    DECREMENT count with 1
ENDWHILE

PRINT the result

END

```