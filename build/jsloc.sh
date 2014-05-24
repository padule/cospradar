#!/bin/bash

echo "Lines of Code (LOC)"

_loc=$(wc -l "$@" /dev/null | tail -n 1 | awk -F' ' '{print $1}')

echo "${_loc}"

exit 0
#EOF
