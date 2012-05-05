<#

Function HbmTypeToCSharp(type, namespace)
	if not type then
		return "string"
	end if
	
	if type = "String" then
		return "string"
	end if
	
	if type = "Int32" then
		return "int"
	end if
	
	if type = "Int16" then
		return "short"
	end if
	
	if type = "Int64" then
		return "long"
	end if
	
	p = type.IndexOf(",")
	
	if p > 0 then
		type = type.Substring(0, p)
		type = type.Trim()
		if type.StartsWith(namespace) then
			type = type.Substring(namespace.Length + 1)
		end if
	end if
			
	return type
End Function

#>