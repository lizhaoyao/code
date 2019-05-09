function dkjson_json_encode(foo, bar)
	local json = require ("dkjson")
	local tbl = {
	  animals = { "dog", "cat", "aardvark" },
	  instruments = { "violin", "trombone", "theremin" },
	  bugs = json.null,
	  trees = nil
	}
	local str = json.encode (tbl, { indent = true })
	return str
end

function dkjson_json_decode(foo,bar)
	local json = require ("dkjson")
	local str = [[
	{
	  "numbers": [ 2, 3, -20.23e+2, -4 ],
	  "currency": "\u20AC"
	}
	]]
	
	local obj, pos, err = json.decode (str, 1, nil)
	if err then
	  print ("Error:", err)
	else
	  for i = 1,#obj.numbers do
		print (i, obj.numbers[i])
	  end
	end
	return obj
end

print(dkjson_json_encode("foo", "bar"))
print(dkjson_json_decode("foo", "bar"))


执行后得到结果
{
  "bugs":null,
  "instruments":["violin","trombone","theremin"],
  "animals":["dog","cat","aardvark"]
}
1	2
2	3
3	-2023.0
4	-4
table: 0x563cb9abff60

