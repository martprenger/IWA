import re

# Read the original SQL statement from a file
with open('station.sql', 'r') as f:
    original_sql = f.read()

# Extract values from the original SQL statement
values_match = re.search(r"VALUES \((.*?)\);", original_sql, re.DOTALL)
if values_match:
    values_str = values_match.group(1)
    # Split values by comma and parentheses
    values = re.findall(r"\((.*?)\)", values_str)

    # Construct new SQL statement with location
    new_sql = "INSERT IGNORE INTO `station` (`name`, `longitude`, `latitude`, `elevation`, `location`) VALUES\n"
    for value in values:
        # Split the tuple by comma
        fields = value.split(',')
        # Extract individual values
        name = fields[0].strip("'")
        longitude = fields[1]
        latitude = fields[2]
        elevation = fields[3]
        # Construct location value
        location = f"ST_PointFromText('POINT({longitude} {latitude})')"
        # Append to new SQL statement
        new_sql += f"('{name}', {longitude}, {latitude}, {elevation}, {location}),\n"

# Remove the trailing comma and newline character from the last line
new_sql = new_sql[:-2] + ";"

# Write the new SQL statement to a file
with open('new_sql.sql', 'w') as f:
    f.write(new_sql)

print("New SQL statement has been written to new_sql.sql")

