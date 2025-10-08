-- local names = {
-- 	"Mebea",
-- 	"Yohannes",
-- 	"Someone"
-- }

-- for index = 1, 3 do
-- 	print("Name", index, names[index])
-- end

-- for _, value in ipairs(names) do
-- 	print(value)
--
-- end

-- local scores = { mebea = 10, john = "N/A"}
--
-- for key, value in pairs(scores) do
-- 	print(key, value)
-- end
--

-- local var = 59

-- if var == true then
-- 	print("var is true")
-- elseif var == nil then
-- 	print("var is nil")
-- else
-- 	print("var is false")
-- end
--

-- local M = {}
--
-- M.call = function()
-- 	print("Call me baby")
-- end
--
-- return M
--
-- local multiple = function()
-- 	return 1, 2, 3, 4
-- end
--
-- local first, second, last = multiple()
-- print(first, second, last)

local parameters = function(...)
	local arguments = {...}
	for _, v in ipairs(arguments) do print(v) end
end

parameters(1, 2, "hello", "world")
